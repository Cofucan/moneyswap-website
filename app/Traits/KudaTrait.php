<?php
namespace App\Traits;

use App\Models\Bank;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\carbon;
use Session;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\Http;
trait KudaTrait {

    $clientKey='OLU968774687B65D9E678753';
    $amount = '20000';
    $amnt = '200';
    $randomString= mt_rand();
    $mackey = 'F5E3BE47E07563AD306F276B1B200BB2204D3E6201DF360D7465D3650D038B28';

    $data = "$merchant_code$amount$uniqueref$mackey";
    $hashed = openssl_digest($data, 'AES256');
    $password = openssl_digest($data, 'RSA');
    $hashed = openssl_digest($data, 'sha512');

    //password = {clientKey}-{randomString};
    public function getkey()
    {
        $seckey= 'FLWSECK-98f875eec99672e93f36b1969f90d67b-X';
        $this->publickey = 'FLWPUBK-5d7f376ed3e45496311ec858c294cade-X';
            $hashedkey = md5($seckey);
            $hashedkeylast12 = substr($hashedkey, -12);
            $seckeyadjusted = str_replace("FLWSECK-", "", $seckey);
            $seckeyadjustedfirst12 = substr($seckeyadjusted, 0, 12);
            $encryptionkey = $seckeyadjustedfirst12.$hashedkeylast12;
            return $encryptionkey;
    }

    public function encryptdata()
    {
        return base64_encode(openssl_encrypt($this->dataReq, 'DES-EDE3', $this->encryptionkey, OPENSSL_RAW_DATA));
    }

    public function AcceptPayment()
    {
        if(!isset($this->note)){
            $note_id = !empty($this->data['note_id']) ? $this->data['note_id'] : $this->note_id;
            $this->note = Note::findorFail($note_id);
        }
        $this->payment = new Payment;
        $this->payment->amount = !empty($this->amount) ? $this->amount : $this->note->amount;
        $this->payment->currency = !empty($this->currency) ? $this->currency : $this->note->currency;

        $this->payment->receipt_no = !empty($this->receipt_no) ? $this->receipt_no : $this->generateReceiptNo();
        $this->payment->status = !empty($this->status) ? $this->status : 'Received';
        if ( !$this->note->Payment()->save($this->payment)) {
            'error', 'Something went wrong, try later' = 'payment advise undefined';
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
        $this->note->status = 'Approved';
        $this->note->value_date = Carbon::now();
        $this->note->save();
        // schedule email and or sms
        return $this->payment;
    }

    public function generateVirtualAccount()
    {
        if(!isset($this->cause)){
            $this->cause = Cause::findOrFail(!empty($this->data['wallet_id']) ? $this->data['wallet_id'] : $this->wallet_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken($this->SECKEY)
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
        $bank = Bank::findOrFail(!empty($this->data['bank_id']) ? $this->data['bank_id'] : $this->bank_id);

        $apikey = $this->SECKEY;
        $response = Http::withHeaders([
                      	'accept' => 'application/json'
                      ])
                      ->withToken($this->SECKEY)
                      ->get('https://api.flutterwave.com/v3/accounts/resolve',
                      [
                        'account_number' => $this->data['account_number'],
                        'account_bank' => $bank->code,
                      ])
                      ->json();
        //return response()->json($response);
        return $response;
    }


    public function makeVirtualCard()
    {
        if(!isset($this->cause)){
            $this->cause = Cause::findOrFail(!empty($this->data['wallet_id']) ? $this->data['wallet_id'] : $this->wallet_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken($this->SECKEY)
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
          ->withToken($this->SECKEY)
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
    public function makeTransfer()
    {
        if(!isset($this->transfer)){
            $this->transfer = Transfer::findOrFail(!empty($this->data['transfer_id']) ? $this->data['transfer_id'] : $this->transfer_id);
        }
        $response = Http::withHeaders([
            'accept' => 'application/json'
          ])
          ->withToken($this->SECKEY)
          ->post('https://api.flutterwave.com/v3/transfers',
          [
              'currency' => $this->cause->currency_code,
              'amount' => $this->transfer->amount,
              'account_bank' => $this->transfer->beneficiary->bank_code,
              'account_number' => $this->transfer->beneficiary->bank_account,
              'narration' => $this->transfer->narration,
              'reference' => $this->transfer->reference_code,
              'debit_currency' => $this->transfer->cause->currency_code,
              'callback_url' => 'https://moneyswap.xyz/virtualcard/cardnotice', //card transaction notification
          ])->json();
        if($response->status =='success' && $response->data->response_code =='02')
        {
            //update trnasfer
            return  $response;
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
          ->withToken($this->SECKEY)
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
