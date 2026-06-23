<?php

namespace Modules\CommunicationManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
class Incident extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'incident_category_id',
        'overview',
        'incidentable_id',
        'incidentable_type',
        'academic_term_id',
        'user_id',
        'slug',
        'severity',
        'status', // scheduled, active,  resolved, closed
        'closed_at',
        'published'
        ];

        protected $attributes =
        [
            'published' => true,
        ];
        public static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                $model->user_id = Auth::user()->id;
                $model->slug =  Str::slug($model->label).'-'.time();
            });
            // static::updating(function ($model) {
            //     $model->slug =  Str::slug($model->label);
            // });

        }
        public function getRouteKeyName()
        {
            return 'slug';
        }

        public function IncidentCategory()
        {
            return $this->belongsTo(IncidentCategory::class);
        }

        public function User()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function incident()
        {
            return $this->morphTo();
        }

        public function Profile()
        {
            return $this->belongsTo('ProfileManagement\Entities\Profile');
        }

        public function IncidentItems()
        {
            return $this->hasMany(IncidentItem::class);
        }

        public function scopeCategory($query, $categoryId)
        {
            return $query->where('incident_category_id', $categoryId);
        }

        public function getSummaryAttribute()
        {
            return Str::limit($this->answer, $limit = 100, $end = '...');
        }
        public function scopeActive($query)
        {
            return $query->with('IncidentCategory')->where('published', true);
        }

        public function scopeOwn($query)
        {
            return $query->where('user_id',  Auth::id())->orderBy('created_at', 'Desc')->get();
        }

        public function scopeOwner($query, $profileId)
        {
            return $query->where('profile_id',  $profileId)->orderBy('created_at', 'Desc')->get();
        }

        public function scopeAvailable($query)
        {
            return $query->with('IncidentCategory');
        }

        public function getCreatorAttribute()
        {
            return $this->User->Profile->full_name;
        }

        public function getCloseDateAttribute()
        {   
                return Carbon::parse($this->closed_at)->toDayDateTimeString();
        }

        public function Comments()
        {
            return $this->morphMany(Comment::class, 'commentable');
        }
}
