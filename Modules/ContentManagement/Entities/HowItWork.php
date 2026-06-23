<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class HowItWork extends Model
{
    //
protected $fillable= [
'label',
'forwhom',
'overview',
'display_image',
'published',
'button_text',
'button_url',
'display_order',
'how_it_work_group_id'
];

    public static function boot()
    {
        parent::boot();
            static::creating(function ($model) {
                $model->slug = Str::slug($model->label);
            });
            static::updating(function ($model) {
                $model->slug = Str::slug($model->label);
            });
       
    }

    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 300, $end = '...');
    }
    public function scopeActive($query)
    {
        return $query->where('published', true);
    }

    public function scopePublic($query)
    {
        return $this->scopeForAudience($query, 'Prospects');
    }
    
    public function scopeBid($query)
    {
        return $this->scopeForAudience($query, 'Bidding');
    }

    public function scopeSwap($query)
    {
        return $this->scopeForAudience($query, 'Swapping');
    }

    public function group()
    {
        return $this->belongsTo(HowItWorkGroup::class, 'how_it_work_group_id');
    }

    public function groups()
    {
        return $this->belongsToMany(
            HowItWorkGroup::class,
            'how_it_work_group_items',
            'how_it_work_id',
            'how_it_work_group_id'
        )->withPivot('display_order', 'is_enabled')->withTimestamps();
    }

    public function scopeRequesting($query)
    {
        return $this->scopeForAudience($query, 'Requesting');
    }

    public function scopeMembership($query)
    {
        return $this->scopeForAudience($query, 'Members');
    }

    public function scopeInvestment($query)
    {
        return $this->scopeForAudience($query, 'Investment');
    }

    public function scopeClient($query)
    {
        return $this->scopeForAudience($query, 'Store');
    }

    public function scopeForAudience($query, $audience)
    {
        $hasEnabledFlag = Schema::hasTable('how_it_work_group_items')
            && Schema::hasColumn('how_it_work_group_items', 'is_enabled');

        return $query->where('published', true)->where(function ($nested) use ($audience, $hasEnabledFlag) {
            $nested->where('forwhom', $audience)
                ->orWhereHas('groups', function ($groupQuery) use ($audience, $hasEnabledFlag) {
                    $groupQuery->where('name', $audience);
                    if ($hasEnabledFlag) {
                        $groupQuery->where('how_it_work_group_items.is_enabled', true);
                    }
                });
        });
    }

}
