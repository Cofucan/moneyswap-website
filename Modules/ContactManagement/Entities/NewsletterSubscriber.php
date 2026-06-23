<?php

namespace Modules\ContactManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    //
    protected $fillable =[
        'subscriber_email',
        'optout_date'
    ];

    protected $attributes =
    [
        
        'active' => '1',
    ];
}
