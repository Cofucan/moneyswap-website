<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;
use Auth;

class Photo extends Model
{
    //
    const DURATION = '45';
    protected $fillable = [
        'owner_type',
        'slug',
        'album_id',
        'owner_id',
        'file_path',
        'overview',
        'media_type',
        'thumbnail',
        'published'      
    ];  
    protected $attributes =[
        'published' => true,
    ];
    public static function boot()
    {
        parent::boot();
        // static::saving(function ($model) {
        //     $model->slug = Str::slug($model->file_name);
        // });
        // static::updating(function ($model) {
        //     $model->slug = Str::slug($model->file_name);
        // });
    }

    public function Album()
    {
        return $this->belongsTo(Album::class); 
    }

   public function scopeGallery($query, $album = null)
   {
    if(is_null($album))
    {
        return $query->with('Album', 'Owner')->latest();
    }
       return $query->with('Album', 'Owner')
                    ->whereHas('Album', function($query) {
                        $query->where('slug', $this->album);
                    })->orderBy('created_at', 'Desc');
   }

   public function scopePictures($query, $album)
   {    
       return $query->with('Album', 'Owner')->where('album_id', $album->id)->orderBy('created_at', 'Desc');
   }
 
    public function owner()
    {
    return $this->morphTo();
    }
       
}
