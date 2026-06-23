<?php

namespace Modules\ContactManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;
class Lead extends Model
{
    //
    use HasFactory, Hashidable;
    protected $fillable=[
    'contact_id',
    'sales_cycle_id', 
    'designation_id',

    ];

    protected $attributes =
    [
        // 'contact_tag' => 'Default',
    ];

    public function getContactNameAttribute()
    {
        return $this->Contact->last_name. ' '. $this->Contact->first_name;
    }

    public function getCycleAttribute()
    {
        return $this->SalesCycle->label;
    }
    
    public function getPositionAttribute()
    {
        return $this->Designation->job_role;
    }

    public function getCompanyNameAttribute()
    {
        if(is_null($this->Contact->organization_id))
        {
            return 'N/A';
        }
        return $this->Contact->Organization->legal_name;
    }

    public function Designation()
    {
        return $this->belongsTo('Modules\HumanResources\Entities\Designation');
    }

    public function SalesCycle()
    {
        return $this->belongsTo(SalesCycle::class);
    }

    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
