<?php
namespace Modules\CatalogManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Program extends Model
{
    protected $fillable = [
        'label',
        'parent_id',
        'cause_id',
        'overview',
        'tenure_months',
        'slug',
        'graduation_qualification',
        'favicon',
        'display_image',
        'enabled'
    ];
    protected $attributes = [
        'enabled' => true,
        'parent_id' => '0'
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
          self::deleting(function ($model) {
            $model->Levels()->each(function($level){
                $level->delete();
            });
        });
    }
    public function Cause()
    {
        return $this->belongsTo(Cause::class);
    }
    public function Parent()
    {
        return $this->belongsTo(Program::class, 'parent_id')->withDefault('N/A');
    }
    public function getRouteKeyName()
    {
        return 'tag';
    }
    public function Child()
    {
        return $this->hasOne(Program::class, 'parent_id');
    }
    public function Children()
    {
        return $this->hasMany(Program::class, 'parent_id');
    }

    public function Events()
    {
        return $this->hasMany('Modules\ContentManagement\Entities\Event');
    }
    public function Levels()
    {
        return $this->hasMany(Level::class);
    }  


    public function Qualification()
    {
        return $this->hasOne('Modules\EmploymentManagement\Entities\Qualification');
    }

    public function Requirements()
    {
    return $this->hasMany('Modules\ScholarshipManagement\Entities\Requirement');
    }



    public function Fees()
    {
        return $this->morphMany('Modules\FeeManagement\Entities\Fee', 'feeable');
    }

    public function RegistrationFee()
    {
/*         return $this->morphOne(Fee::class)
                ->whereHas('feefeetype', function($q){
                    $q->where('created_at', '>=', '2015-01-01 00:00:00');
                })->latestOfMany();
 */
    return $this->morphOne(Fee::class)->where('fee_type_id', 22)->latestOfMany();
        //return $this->morphOne(Fee::class)->where('fee_type_id', 22)->oldestOfMany());
    }


    public function scopeActive($query, $causeId=null)
    {
        $query = $query->where('enabled', true);
        if(isset($causeId))
        {
            $query->where('cause_id', $causeId);
        }
        return $query;
    }
    public function scopeUnpublished($query)
    {
        return $query->where('enabled', false);
    }
    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 65, $end = '...');
    }

}
