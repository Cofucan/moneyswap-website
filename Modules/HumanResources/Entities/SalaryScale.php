<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class SalaryScale extends Model
{
    //
    protected $fillable = [
        'salary_scale',
        'designation_id',
        'qualification',
        'employment_type_id',
        'employee_status',
        'basic_pay',
        'payment_frequency',
        'currency',
        'published'
            ];
    protected $attributes =
    [
        'published' => '1',
    ];
        public function Employments()
        {
        return $this->hasMany(Employment::class);
        }

        public function Designation()
        {
        return $this->belongsTo(Designation::class);
        }

        public function Qualification()
        {
        return $this->belongsTo('Modules\HumanResources\Entities\Qualification', 'qualification');
        }

        public function PaymentFrequency(){
            return $this->belongsTo('Modules\PaymentManagement\Entities\PaymentFrequency', 'payment_frequency');
        }

        public function Payslips()
        {
            return $this->hasManyThrough(Salary::class, Employment::class);
        }

        public function SalaryAdjustment()
        {
            return $this->hasMany(SalaryAdjustment::class);
        }
        public function EmployeeType()
        {
        return $this->belongsTo('Modules\HumanResources\Entities\EmploymentType');
        }
}
