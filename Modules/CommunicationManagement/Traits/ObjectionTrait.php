<?php

namespace Modules\CommunicationManagement\Traits;

use Illuminate\Http\Request;
use Modules\CommunicationManagement\Entities\Objection;
use Session;
use Carbon\Carbon;

trait ObjectionTrait {


    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function makeObjection()
    {
        $objection = new Objection;   
        $objection->reason = !empty($this->data['reason']) ? $this->data['reason'] : $this->reason;
        return $objection;
       
    }
    public function saveObjection()
    {
        $this->objection = $this->makeObjection();               
        $this->objection->objectionable_type = !empty($this->data['objectionable_type']) ? $this->data['objectionable_type'] : NULL;
        switch ($this->objection->objectionable_type){
            case "budget":
                if(!isset($this->budget))
                {
                    $this->budget = Budget::find(!empty($this->data['budget_id']) ? $this->data['budget_id'] : $this->objectionable_id);
                }
                $this->budget->Objections()->save($this->objection);
            break;
            case "vacancy":
                if(!isset($this->vacancy))
                {
                    $this->vacancy = Vacancy::find(!empty($this->data['vacancy_id']) ? $this->data['vacancy_id'] : $this->objectionable_id);
                }
                $this->vacancy->Objections()->save($this->objection);
            break;
            case "expense":
                if(!isset($this->expense))
                {
                    $this->expense = Expense::find(!empty($this->data['expense_id']) ? $this->data['expense_id'] : $this->objectionable_id);
                }
                //$this->objection->tax = !empty($this->data['tax']) ? $this->data['tax'] : 0;
                //$this->objection->allow_partpayment = !empty($this->allow_partpayment) ? $this->allow_partpayment : '1';
                if($this->expense->Advices()->save($this->objection)){
                    //post to expense
                    //return as required
                
                }
            break;
            default:
            $this->objection->save();
        }
       
//$toUser->notify(new NewMessage($fromUser));
            //Auth::User()->notify(new NewInvoice());
    
    return $this->objection;
}

public function processObjection()
{
    if(!isset($this->objection)){
        $this->objection = Objection::findorFail(!empty($this->data['objection_id']) ? $this->data['objection_id'] : $this->objection_id);
    }
    $this->objection->resolved = true;   
    $this->objection->resolved_at = Carbon::now();
    $this->objection->objectionable->status = 'Scheduled';  
    if($this->objection->push())
    {
        //send notification
        //$toUser->notify(new NewMessage($fromUser));
            //Auth::User()->notify(new NewInvoice());
    }
        return $this->objection;
}



public function sendNotification()
{
    $objection = [
        'greeting' => '',
        'body' => '',
        'thanks' => 'Thank you for your objection',
        'actionText' => 'View Receipt',
        'actionUrl' => url('/'),
        'invoice_id' => $this->objection->id
    ];
    Notification::send($user, new PaymentReceived($objection));
}





}
