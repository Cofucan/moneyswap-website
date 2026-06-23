<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message;

   /*  public function __construct($message)
    {
        $this->message = $message;
    }
 */
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        /* $address = 'adesanusi@systempace.com';
        $subject = 'This is a demo!';
        $name = 'Jane Doe';

        return $this->view('newslettersubscriptions.emails.newsubcription')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'message' => $this->data['message'] ]); */


                    $from_email = $this->message['from_email'];
                    $subject = $this->message['email_subject'];
                    $name = $this->message['sender_name'];

                    return $this->view('newslettersubscriptions.emails.newsubcription')
                                ->from($from_email, $name)
                                ->cc($from_email, $name)
                               // ->bcc($address, $name)
                                ->replyTo($from_email, $name)
                                ->subject($subject)
                                ->with([ 'message' => $this->message['email_body'] ]);
    }
}
