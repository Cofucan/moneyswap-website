<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
//use App\Models\Country;
use App\Models\Profile;
use Carbon\carbon;
use Session;
use Mail;
use DB;
trait WalletTrait {

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveWallet()
    {
        $profile = Profile::findorFail(!empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile->id);
        if(!isset($profile)){
            return redirect()->back()->withInput()->withErrors('error', 'Profile not found');
        }
        $this->wallet = new Wallet;
        $this->wallet->currency_id = !empty($this->data['currency_id']) ? $this->data['currency_id'] : $profile->country->currency->id;
        $this->wallet->reference_token = time().$this->profile->country->currency->code.$this->profile->id;
        if ( !$profile->wallet()->save($this->wallet)) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong');
        }
        return $this->wallet;
    }
public function spendable($walletId)
{
    $wallet = Wallet::findOrFail($walletId);
    return $wallet->balance;

}

    public function walletTransaction($walletId, $type, $amount)
    {
        $wallet = Wallet::findorFail($walletId);
        if(!isset($wallet)){
            return redirect()->back()->withInput()->withErrors('error', 'Wallet not found');
        }
        switch ($type){
            case "fund":

                DB::transaction ( function() use ($wallet, $amount){
                    Transaction::create([
                        'wallet_id' => $wallet->id,
                        'amount' => $amount,
                        'currency_id' => $wallet->currency_id,
                        'transaction_type' => 'Inflow',
                        'narration' => 'Wallet Funding',
                    ]);
                    $wallet->balance += $amount;
                    $this->feedback = 'Wallet funding successful';
                    });

            break;
            case "charge":
                DB::transaction ( function() use ($wallet, $amount){
                    Transaction::create([
                        'wallet_id' => $wallet->id,
                        'amount' => $amount,
                        'currency_id' => $wallet->currency_id,
                        'transaction_type' => 'Outflow',
                        'narration' => 'Wallet Funding',
                    ]);
                    $wallet->blocked -= $amount;
                    $this->feedback =  $wallet->currency_code .' ' . number_format($amount,2) . ' just got deducted from your wallet';
                    });

            break;
            case "block":

                $wallet->balance -= $amount;
                $wallet->blocked += $amount;
            $this->feedback = 'A Transaction of ' . $amount . ' is about to be initiated on your wallet';
            break;
            case "unblock":
                $wallet->blocked -= $amount;
                $wallet->balance += $amount;

            $this->feedback = $amount . ' has been unblocked on your wallet';
            break;
            }
            if($wallet->save())
            {
                //send status change email
               // Mail::to($wallet->profile->user->email)->send(new OrderShipped($offer));

               return $wallet;
            }

    }


}
