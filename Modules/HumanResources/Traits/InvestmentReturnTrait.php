<?php
namespace App\Traits;
use App\Models\InvestmentReturn;
use App\Models\Investment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Traits\MemberTrait;
use Carbon\carbon;
use Session;
use App\Notifications\NewInvestmentReturn;
trait InvestmentReturnTrait {
use MemberTrait;

    public function saveInvestmentReturn()
    {
        
        if(!isset($this->investment)){
            $this->investment = Investment::findOrFail(!empty($this->data['investment_id']) ? $this->data['investment_id'] : $this->investment_id);
        }  
        $this->investmentreturn = new InvestmentReturn;                    
        // $this->investmentreturn->currency = $this->data['currency'];       
        $this->investmentreturn->amount = $this->investment->monthly_return;
        $this->investmentreturn->due_at = !empty($this->data['due_at']) ? $this->data['due_at'] : $this->due_at;  
        $this->investmentreturn->sequence_no = !empty($this->data['sequence_no']) ? $this->data['sequence_no'] : $this->sequence_no;  
        if ( !$this->investment->investmentreturns()->save($this->investmentreturn)) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->investmentreturn;
    }


    

    public function processInvestmentReturns()
    {
        if(!isset($this->investmentreturn)){
            $this->investmentreturn = InvestmentReturn::findOrFail(!empty($this->data['investment_return_id']) ? $this->data['investment_return_id'] : $this->investment_return_id);   
        }       
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        if($this->investmentreturn->status == $status)
        {
            return redirect()->back()->with('error', 'Cannot update status to the same status');
        }
        switch ($status){
            case "Paid":  
                $this->investmentreturn->status = 'Paid';
                $this->investmentreturn->reference_code = date('dmY'). '-'.$this->investmentreturn->investment_id.str_pad($this->investmentreturn->sequence_no, 3, '0', STR_PAD_LEFT);
                if($this->investmentreturn->save()){
                    $this->investmentreturn->investment->member->person->user->notify(new NewInvestmentReturn($this->investmentreturn));
                   return $this->investmentreturn; 
                }
                

            $this->feedback = 'Thanks for your patronage. You investmentreturn has been Approved.';
            break;
            case "Acknowledged":
                $this->investmentreturn->received_amount = !empty($this->data['received_amount']) ? $this->data['received_amount'] : $this->investmentreturn->amount;
                $this->investmentreturn->acknowledged_at = Carbon::now();

                $this->feedback = 'Thank you, You just acknowledge the receipt of ' . $this->investmentreturn->received_amount;

            break;
            case "Expired":
            Mail::to($this->investmentreturn->Profile->email)->send(new OrderShipped($investmentreturn));
            $this->feedback = 'Investment Scheduled for shipping, You will get status updates on shipping as they occur';
            //send notification to parents.declined';
            break;
            
            }
            $this->investmentreturn->status = $status;
            if($this->investmentreturn->save()){
                //send status change email
               return $this->investmentreturn; 
            }
    }
    
}
