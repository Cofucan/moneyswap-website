<?php
namespace Modules\ClientManagement\Traits;

use Modules\ClientManagement\Entities\Kindred;
use Modules\ProfileManagement\Entities\Agent;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Carbon\carbon;
use DB;
use Auth;
use Session;

trait KindredTrait {
    use ProfileTrait;

    public function kindredstats()
    {
    return DB::table('kindreds')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Active' then 1 end) as Active")
    ->selectRaw("count(case when status = 'Discontinued' then 1 end) as Discontinued")
    ->selectRaw("count(case when status = 'Expelled' then 1 end) as Expelled")
    ->selectRaw("count(case when status = 'Graduated' then 1 end) as Graduated")
    ->first();
    }
    public function saveKindred()
    {
        $this->data['role_id'] =11;
        $kindred = new Kindred;
        $kindred->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] :  $this->saveProfile()->id;
        $kindred->client_id = !empty($this->data['client_id']) ? $this->data['client_id'] : $this->client_id;
        $kindred->relationship_id = !empty($this->data['relationship_id']) ? $this->data['relationship_id'] : $this->relationship_id;
        $kindred->occupation = !empty($this->data['occupation']) ? $this->data['occupation'] :  NULL;
        $kindred->expired_at = !empty($this->data['expired_at']) ? $this->data['expired_at'] : NULL;
        $kindred->cause_of_death = !empty($this->data['cause_of_death']) ? $this->data['cause_of_death'] : NULL;
        $kindred->status = !empty($this->data['status']) ? $this->data['status'] : 'Alive';
        $kindred->is_verified = !empty($this->data['is_verified']) ? $this->data['is_verified'] : false;
        if(!$kindred->save()) {
            return redirect()->back()->withErrors('Error creating relative record');
        }
        return $kindred;

    }

}
