<?php

namespace Modules\ContactManagement\Traits;

use Modules\ContactManagement\Entities\EmailAccount;
use Modules\ProfileManagement\Entities\Profile;
use Session;
use Carbon\carbon;

trait EmailAccountTrait {

    public function getMail()
    {
        /* connect to gmail */
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'xyz@gmail.com';
        $password = 'xyz';
    
        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect: ' . imap_last_error());
    
        $emails = imap_search($inbox, 'ALL');
    
        if ($emails) {
            $output = '';
            $mails = array();
    
            rsort($emails);
    
            foreach ($emails as $email_number) {
                $header = imap_headerinfo($inbox, $email_number);
                $message = quoted_printable_decode (imap_fetchbody($inbox, $email_number, 1));
    
                $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                $toaddress = $header->toaddress;
                if(imap_search($inbox, 'UNSEEN')){
                    /*Store from and message body to database*/
                    DB::table('email')->insert(['from'=>$from, 'body'=>$message]);
                    return view('emails.display');
                }
                else{
                    $data = Email::all();
                    return view('emails.display',compact('data'));
    
                }
            }
        }
            imap_close($inbox);
    }
    
    public function showMail($id){
    
        // get the id
        $message = Email::findOrFail($id);
        $m = $message->body;
        // show the view and pass the nerd to it
        return view('emails.showmail',compact('m'));
    }




    public function addTelephone($profile)
    {
        if(!empty($this->data['telephone']) || !empty($this->telephone))
        {
            return $this->saveTelephone($profile);
        }


    }

}
