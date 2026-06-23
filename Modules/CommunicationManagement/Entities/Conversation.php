<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use App\Models\User;

class Conversation extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }

    public function replies()
    {
        return $this->hasMany(Conversation::class, 'parent_id');
    }

    public function Message()
    {
        return $this->belongsTo(Message::class);
    }
}
