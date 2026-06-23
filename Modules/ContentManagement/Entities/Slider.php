<?php

namespace Modules\ContentManagement\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, Hashidable;
protected $fillable = [
    'caption',
    'sequence_no',
    'highlight',
    'display_media',
    'button_one',
    'button_one_link',
    'button_two',
    'button_two_link',
    'creator_user_id',
    'published'
];

protected $attributes = [
    'published' => false
    ];

public static function boot()
{
    parent::boot();
    static::creating(function ($model) {
        $model->creator_user_id = Auth::user()->id;
        $model->sequence_no = Slider::max('sequence_no')+1;

    });
}
public function scopeActive($query)
{
    return $query->wherePublished(true);
}
}