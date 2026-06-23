<?php

namespace  Modules\OrganizationManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class OrganizationType extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable = [
        'label',
        'overview',
        // 'income',
        // 'currency',
        // 'clients',
        'is_active'
    ];

    protected $attributes =
    [
        'is_active' => true,
    ];
   
    public function getStatusAtttribute()
    {
        if($this->is_active == true)
        {
            return 'Active';
        }
        return 'Not Active';
                           
    }
    public function Organizations()
    {
        return $this->hasMany(Organization::class);
    }

    
    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }
}
