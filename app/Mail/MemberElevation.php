<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\OrderManagement\Entities\Order;;

class MemberElevation extends Mailable
{
    use Queueable, SerializesModels;
    public $profile;
    public $milestone;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($profile, $milestone)
    {
        $this->profile = $profile;
        $this->milestone = $milestone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.member.elevated');
    }
}
