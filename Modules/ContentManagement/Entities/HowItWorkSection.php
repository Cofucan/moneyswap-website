<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class HowItWorkSection extends Model
{
    protected $fillable = [
        'key',
        'title',
        'subtitle',
        'description',
        'icon',
        'display_order',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'display_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
