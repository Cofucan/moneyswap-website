<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    protected $fillable = [
        'page',
        'section_key',
        'type',
        'headline',
        'subtext',
        'image',
        'data',
        'display_order',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'display_order' => 'integer',
        'data' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
