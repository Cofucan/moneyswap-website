<?php
namespace App\Traits;

use App\Models\Bank;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Carbon\carbon;
use Session;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\Http;
use App\Traits\AdviceTrait;
use App\Traits\WalletTrait;
use Config;

trait FlutterwaveTrait {
    use AdviceTrait;
    use WalletTrait;
    /**
     * Flutterwave API integration methods.
     *
     * @param Request $request
     * @return $this|false|string
     */



    public function generateVirtualAccount()
    {
        if(!isset($this->cause)){
            $this->cause = Cause::findOrFail(!empty($this->data['wallet_id']) ? $this->data['wallet_id'] : $this->wallet_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken(Config('flutterwave.fluttersecret'))
          ->post('https://api.flutterwave.com/v3/virtual-account-numbers',
          [
              'email' => $this->cause->profile->user_email,
              'phonenumber' => $this->cause->profile->user_phone,
              'firstname' => $this->cause->profile->first_name,
              'lastname' => $this->cause->profile->last_name,
              //'amount' => '5500',
              //'bvn' => $this->cause->profile->bvn,
              'tx_ref' => $this->cause->id.time(),
              'frequency' => false,
              'is_permanent' => false,
              'narration' => $this->cause->profile->full_name,
          ])->json();
          if($response->failed())
          {
            print_r('API returned error: ' . $response->message);
          }
         //store virtual accounts
          $bank = Bank::byTag($response->data->bank_name);
         $virtual_account = VirtualAccount::create([
            'reference_token' => $response->data->order_ref,
            'wallet_id' => $this->cause->id,
            'bank_id' => $bank->id,
            'bank_name' => $response->data->bank_name,
            'account_number' => $response->data->account_number,
            //'amount' => $response->data->amount,
            'issued_at' => $response->data->created_at,
            'expired_date' => $response->data->expiry_date,
            'frequency' => $response->data->frequency,
            'note' => $response->data->note,
        ]);

    }


    public function verifyAccount()
    {

        $response = Http::withHeaders([
                      	'accept' => 'application/json'
                      ])
                      ->withToken(Config('flutterwave.fluttersecret'))
                      ->post('https://api.flutterwave.com/v3/accounts/resolve',
                      [
                        'account_number' => $this->data['account_number'],
                        'account_bank' => $this->data['bank_code'],
                      ])->json();
        return $response;
       // return $response['data'];
    }
    public function makeTransfer($transfer)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken(Config('flutterwave.fluttersecret'))
          ->post('https://api.flutterwave.com/v3/transfers',
          [
              'currency' => $transfer->currency,
              'amount' => $transfer->amount,
              'account_bank' => $transfer->bank_code,
              'account_number' => $transfer->bank_account,
              'narration' => $transfer->narration,
              'reference' => $transfer->reference_code,
              'debit_currency' => $transfer->cause->currency_code,
              'callback_url' => 'https://moneyswap.xyz/flutterwave/transferstatus',
          ])->json();
        return $response;
    }

    public function verifyPayment($transactionId)
    {
        //$fluttersecret ='FLWSECK_TEST-5a5da51d99685bc99523a1dcb42d098a-X';
        //$fluttersecret = \Config::get('flutterwave.fluttersecret');
        //$fluttersecret = Config('flutterwave.fluttersecret');
        $response = Http::withHeaders([
                      	'accept' => 'application/json'
                      ])
                      ->withToken(Config('flutterwave.fluttersecret'))
                      ->get("https://api.flutterwave.com/v3/transactions/$transactionId/verify")->json();
        $result = $response['data'];
        //dd($response);
        $status = $result['status'];
        if($status =='successful')
        {
            //$this->advice->narration = 'Cause Funding';
            $this->advice->gateway_fee = $result['app_fee'];
            $this->advice->transaction_method_id = $this->transmethod($result['payment_type']);
            $this->advice->processing_fee = $result['charged_amount'] - $this->advice->amount;
            if(($result['amount'] >= $this->advice->amount) && $this->advice->currency == $result['currency'])
            {
                $this->todo = 'Acknowledge';
            }else{
                $this->advice->status = 'Review';
            }
        }

        $this->advice->gateway_response = $result;
        $this->processAdvice($this->advice);
        return $result;
    }
    public function banklist($country=null)
    {
        $country_code = !empty($country) ? $country : 'NG';
        $response = Http::withHeaders([
                      	'accept' => 'application/json'
                      ])
                      ->withToken(Config('flutterwave.fluttersecret'))
                      ->get("https://api.flutterwave.com/v3/banks/$country_code")->json();

        return $response['data'];
    }


    public function makeVirtualCard()
    {
        if(!isset($this->cause)){
            $this->cause = Cause::findOrFail(!empty($this->data['wallet_id']) ? $this->data['wallet_id'] : $this->wallet_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken(Config('flutterwave.fluttersecret'))
          ->post('https://api.flutterwave.com/v3/virtual-cards',
          [
              'currency' => $this->cause->currency_code,
              'amount' => $this->data['amount'],
              'billing_name' => $this->cause->profile->full_name,
              'billing_address' => $this->cause->profile->full_name,
              'billing_city' => $this->cause->profile->full_name,
              'billing_state' => $this->cause->profile->address->state_code,
              'billing_postal_code' => $this->cause->profile->full_name,
              'billing_country' => false,
              'callback_url' => 'https://moneyswap.xyz/virtualcard/notice', //card transaction notification
          ])->json();
        if($response->status =='success' && $response->data->response_code =='02')
        {
            //store virtual card
            $virtual_account = VirtualCard::create([
                'reference_token' => $response->data->id,
                'card_type' => $response->data->card_type,
                'masked_pan' => $response->data->masked_pan,
                'currency' => $response->data->currency,
                'issued_at' => $response->data->created_at,
                'expired_at' => $response->data->expiration,
                'is_active' => $response->data->is_active,
            ]);
        }
        // there was an error from the API
        print_r('API returned error: ' . $response->message);
    }

    public function makeSubaccount()
    {
        if(!isset($this->bank)){
            $bank = Bank::findOrFail(!empty($this->data['bank_id']) ? $this->data['bank_id'] : $this->bank_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken(Config('flutterwave.fluttersecret'))
          ->post('https://api.flutterwave.com/v3/subaccounts',
          [
              'country' => $this->cause->currency_code,
              'business_contact_mobile' => $this->data['amount'],
              'business_contact' => $this->cause->profile->full_name,
              'account_bank' => $bank->code,
              'account_number' => $this->cause->profile->full_name,
              'business_name' => $this->cause->profile->address->state_code,
              'business_email' => $this->cause->profile->full_name,
              'business_mobile' => $this->cause->profile->full_name,
              'split_type' => 'percentage',
              'split_value' => 0.98,
              'callback_url' => 'https://moneyswap.xyz/virtualcard/notice', //card transaction notification
          ])->json();
        if($response->status =='success' && $response->data->response_code =='02')
        {
            //store virtual card
            $virtual_account = VirtualCard::create([
                'reference_token' => $response->data->subaccount_id,
                'card_type' => $response->data->account_number,
                'masked_pan' => $response->data->account_bank,
                'currency' => $response->data->full_name,
                'issued_at' => $response->data->created_at,
                'expired_at' => $response->data->split_type,
                'is_active' => $response->data->split_value,
            ]);
        }
        // there was an error from the API
        print_r('API returned error: ' . $response->message);
    }

    public function chargebank()
    {
        if(!isset($this->cause)){
            $this->cause = Cause::findOrFail(!empty($this->data['wallet_id']) ? $this->data['wallet_id'] : $this->wallet_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken(Config('flutterwave.fluttersecret'))
          ->post('https://api.flutterwave.com/v3/charges?type=debit_uk_account',
          [
              'account_bank' => $this->cause->currency_code,
              'account_number' => $this->data['amount'],
              'amount' => $this->cause->profile->full_name,
              'fullname' => $this->cause->profile->full_name,
              'currency' => $this->cause->profile->full_name,
              'tx_ref' => $this->cause->profile->address->state_code,
              'email' => false,
              'phone_number' => 'https://moneyswap.xyz/virtualcard/notice', //card transaction notification
          ])->json();
        if($response->status =='success' && $response->data->response_code =='02')
        {
            //store virtual card
            $virtual_account = VirtualCard::create([
                'reference_token' => $response->data->id,
                'card_type' => $response->data->card_type,
                'masked_pan' => $response->data->masked_pan,
                'currency' => $response->data->currency,
                'issued_at' => $response->data->created_at,
                'expired_at' => $response->data->expiration,
                'is_active' => $response->data->is_active,
            ]);
        }
        // there was an error from the API
        print_r('API returned error: ' . $response->message);
    }



    public function generateReceiptNo()
    {
        return date('ymd').rand(1111,9999);
    }
}
