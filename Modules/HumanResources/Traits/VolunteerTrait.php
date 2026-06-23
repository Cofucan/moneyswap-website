<?php
namespace Modules\HumanResources\Traits;
use Modules\HumanResources\Entities\Volunteer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Carbon\carbon;
use Session;
use App\Notifications\NewInvestment;
trait VolunteerTrait {
use ProfileTrait;
    public function saveInvestment()
    {
        $investmentplan = InvestmentPlan::findOrFail(!empty($this->data['investment_plan_id']) ? $this->data['investment_plan_id'] : $this->investment_plan_id);
        $this->volunteer = new Investment;                    
        $this->volunteer->member_id = !empty($this->data['member_id']) ? $this->data['member_id'] : $this->member->id;           
        $this->volunteer->payment_method = $this->data['payment_method'];       
        $this->volunteer->capital = (float) str_replace(',', '', $this->data['capital']);  
        $this->volunteer->processing_fee = ($investmentplan->package->percentage_fee/100) * $this->volunteer->capital;    
        $this->volunteer->interest_rate = $investmentplan->interest_rate; 
        $this->volunteer->label = !empty($this->data['label']) ? $this->data['label'] : $investmentplan->package->name;     
        if ( !$investmentplan->investments()->save($this->volunteer)) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $this->data['payment_method'] = $this->volunteer->payment_method;
        $this->data['invoiceable_type'] = 'volunteer';
        $this->data['invoiceable_id'] = $this->volunteer->id;
        if($this->saveInvoice())
        {
            return $this->volunteer;
        }
        
    }

    
    public function processInvestment()
    {
        if(!isset($this->volunteer)){
            $this->volunteer = Volunteer::findOrFail(!empty($this->data['volunteer_id']) ? $this->data['volunteer_id'] : $this->volunteer_id);   
        }       
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        if($this->volunteer->status == $status)
        {
            return redirect()->back()->with('error', 'Cannot update status to the same status');
        }
        switch ($status){
            case "Approved":  
                $this->volunteer->commence_at = Carbon::today();
                $this->volunteer->approvedby_user_id = Auth::id();
                $months = $this->volunteer->investmentplan->investmentduration->duration_months;
                $portfolio_no = Investment::where('activated',true)->count()+1;
                $this->volunteer->portfolio_no = 'CFI/'.date('my').'/'.str_pad($portfolio_no, 4, '0', STR_PAD_LEFT);
                $this->volunteer->mature_at = Carbon::now()->addMonths($months);
                $this->volunteer->status = 'Approved';
                $this->volunteer->activated = true;
                if($this->volunteer->save()){
                    //schedule returns
                    for($x= 1; $x <=$months; $x++)
                    {
                        $this->due_at = Carbon::now()->addMonths($x);
                        $this->sequence_no = $x;
                        $this->saveInvestmentReturn();
                    }
                    
                    $this->volunteer->member->person->user->notify(new NewInvestment($this->volunteer));
                   return $this->volunteer; 
                }
                

            $this->feedback = 'Thanks for your patronage. You volunteer has been Approved.';
            break;
            case "Rejected":
                $this->feedback = 'We are sorry, your volunteer has been declined, see rejection note or contact the admin';
                $this->volunteer->rejection_reason = !empty($this->data['rejection_reason']) ? $this->data['rejection_reason'] : NULL;

            break;
            case "Expired":
            Mail::to($this->volunteer->Profile->email)->send(new OrderShipped($volunteer));
            $this->feedback = 'Investment Scheduled for shipping, You will get status updates on shipping as they occur';
            //send notification to parents.declined';
            break;
            
            }
            $this->volunteer->status = $status;
            if($this->volunteer->save()){
                //send status change email
               return $this->volunteer; 
            }
    }
    
}
