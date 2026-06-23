<?php
namespace Modules\ClientManagement\Traits;

use Modules\ClientManagement\Entities\Client;
use Modules\ProfileManagement\Entities\Agent;
use Modules\CatalogManagement\Entities\Level;
use Modules\ProfileManagement\Traits\ProfileTrait;

use Illuminate\Support\Str;
use Carbon\carbon;
use DB;
use Auth;
use Session;

trait ClientTrait {
    use ProfileTrait;

    public function clientstats()
    {
    return DB::table('clients')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Active' then 1 end) as Active")
    ->selectRaw("count(case when status = 'Discontinued' then 1 end) as Discontinued")
    ->selectRaw("count(case when status = 'Expelled' then 1 end) as Expelled")
    ->selectRaw("count(case when status = 'Graduated' then 1 end) as Graduated")
    ->first();
    }
    public function saveClient()
    {
        $this->data['role_id'] =10;
        $client = new Client;
        $client->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] :  $this->saveProfile()->id;
        $client->agent_id = !empty($this->data['agent_id']) ? $this->data['agent_id'] : NULL;
        $client->relationship_id = !empty($this->data['relationship_id']) ? $this->data['relationship_id'] : NULL;
        $client->reference = !empty($this->data['reference']) ? $this->data['reference'] : NULL;
        $client->cohort_id = !empty($this->data['cohort_id']) ? $this->data['cohort_id'] : NULL;
        $client->program_id = !empty($this->data['program_id']) ? $this->data['program_id'] :  $this->program_id;
        $client->client_category_id = !empty($this->data['client_category_id']) ? $this->data['client_category_id'] : NULL;
        $client->outlet_id = !empty($this->data['outlet_id']) ? $this->data['outlet_id'] : 2;
        $client->position_in_family = !empty($this->data['position_in_family']) ? $this->data['position_in_family'] :  NULL;
        $client->status = !empty($this->data['status']) ? $this->data['status'] : 'Draft';
        $client->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : false;
        if(!$client->save()) {
            return redirect()->back()->withErrors('Error creating client record');
        }
        return $client;

    }
    public function activator2($client = null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] : $this->orphan_id);
        }
        DB::transaction ( function() use ($client){
            $client->enabled = true;
            $client->batch_id = !empty($this->data['batch_id']) ? $this->data['batch_id'] : $this->batch_id;
            $client->client_category_id = !empty($this->data['client_category_id']) ? $this->data['client_category_id'] : $this->client_category_id;
            $client->status = 'Active';
            $client->left_at = null;
            $client->profile->status = $client->status;
            $client->push();
            $this->termbiller($client);
            return $client;
        });
    }

    public function deactivate($client = null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] : $this->orphan_id);
        }
        $client->enabled = false;
        $client->status = 'Discontinued';
        $client->left_at = Carbon::today();
        $client->profile->status = 'Inactive';
        if($client->push())
        {
            if(!is_null($client->PayableInvoices()))
            {
                $invoices = $client->PayableInvoices();
                $this->data['status'] = 'Cancelled';
                foreach($invoices as $invoice)
                {
                    $this->processInvoice($invoice);
                }
            }
        }
        return $client;
    }
    public function makeChange($client =null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] :$this->orphan_id);
        }
        $client->client_category_id = !empty($this->data['client_category_id']) ? $this->data['client_category_id'] : $client->client_category_id;
        $client->batch_id = !empty($this->data['batch_id']) ? $this->data['batch_id'] : $client->batch_id;
        if($client->save()){
            $this->rebill($client);
        }
        return $client;

    }

    public function makeClient($profile = null)
    {
        if(is_null($profile) || !empty($this->data['first_name']))
        {
            $profile = $this->makeProfile();
            unset($this->data['first_name']);
            unset($this->data['last_name']);
        }
        return $this->saveClient($profile);
    }


    public function generateReference($client = null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] : $this->orphan_id);
        }
        if(is_null($client->reference))
        {
            $client->reference = Client::max('reference')+1;
        }
        $rollnumber = Str::padLeft($client->reference,4,'0');
        $client->reference=  $client->Outlet->reference.$rollnumber;
        return $client->save();
    }
    public function regularize($client = null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] : $this->orphan_id);
        }
        $phone = $client->sponsor->telephone;
        if(is_numeric($phone) && strlen($phone) > 10){
            $family_phone = substr($phone,-10);
            $reference=  $family_phone.$client->child_number;
        }else{
            $rollnumber = Str::padLeft($client->id,4,'0');
            $reference=  $client->outlet->reference.$rollnumber;
        }
        $client->reference=  $reference;
        $client->enabled = true;
        $client->status = 'Active';
        if($client->save()){
            $this->saveWallet($client);
        }
        return $client;
    }
    public function generateAdmissionNumber($client = null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] : $this->orphan_id);
        }
        if(is_null($client->name))
        {
            $client->name = $client->outlet->Merchant->acronym. $client->Admission->admission_year.'/' .Str::padLeft($client->reference,5,'0');
            $client->save();
        }
        return $client;
    }
    public function processStudent($client = null)
    {
        if(is_null($client))
        {
            $client = Client::findOrFail(!empty($this->data['orphan_id']) ? $this->data['orphan_id'] : $this->orphan_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        if($client->status == $status)
        {
            return redirect()->back()->with('Error', 'Invalid action specified');
        }
        //
        switch ($status){
            case "Scheduled":
                $client->enabled = true;
            break;
            case "Approved":
                return $this->regularize($client);
            break;
            case "Graduated":
                $client->enabled = false;
                $client->profile->status = 'Disabled';
            break;
            case "No-show":
                $client->enabled = false;
                $client->profile->status = 'Disabled';
            break;
            }
            $client->status= $status;
            if($client->save()){
                return $client;
            }
    }





}
