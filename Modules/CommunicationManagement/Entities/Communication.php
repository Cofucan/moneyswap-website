<?php

namespace Modules\CommunicationManagement\Entities;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Communication extends Model
{
    //
    protected $fillable = [
        'subject',
        'slug',
        'details',
        'activity_type',
        'value_date',
        'user_id',
        'enrolment_id'
        ];
        public static function boot()
        {
            parent::boot();
            static::saving(function ($model) {
                $model->user_id = Auth::user()->id;
                $model->slug = Str::slug($model->subject);
            });
            static::updating(function ($model) {
                $model->slug = Str::slug($model->subject);
            });
        }

        public function User()
        {
            return $this->belongsTo('App/Models/User');
        }

        public function Enrolment()
        {
            return $this->belongsTo('Modules\EnrolmentManagement\Entities\Enrolment');
        }

        public function ActivityType()
        {
            return $this->belongsTo(ActivityType::class, 'activity_type');
        }

        public function getSentDateAttribute($value)
    {
//        return Carbon::parse($value)->format('l jS \\of F Y ');
            return Carbon::parse($this->sent_at)->toDayDateTimeString();
    }

        public function scopeByParent($query, $profile_id)
        {
            $this->profile_id = $profile_id;
            return $query->with('Enrolment', 'Enrolment.Client', 'Enrolment.Client.Admission.Profile')
                    ->whereHas('Enrolment.Client.Admission.Agent', function($item){
                        $item->where('profile_id', $this->profile_id);
                    })->orderBy('created_at', 'Desc');
        }
        public function scopeByProfile($query, $profile_id)
        {
            $this->profile_id = $profile_id;
            return $query->with('Enrolment', 'Enrolment.Client', 'Enrolment.Client.Profile')
                    ->whereHas('Enrolment.Client', function($item){
                        $item->where('profile_id', $this->profile_id);
                    })->orderBy('created_at', 'Desc');
        }

        public function scopeByTerm($query, $academic_term_id)
        {
            $this->academic_term_id = $academic_term_id;
            return $query->with('Enrolment', 'Enrolment.Client', 'Enrolment.Client.Profile')
                        ->whereHas('Enrolment', function($item){
                            $item->where('academic_term_id', $this->academic_term_id);
                        })->orderBy('created_at', 'Desc');
        }
}
