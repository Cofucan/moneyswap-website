<?php

namespace Modules\CatalogManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kayandra\Hashidable\Hashidable;

class PriceCategory extends Model
{
    //
    use HasFactory, Hashidable;
    protected $table = 'item_categories';
    protected $fillable = [
        'label',
        'overview',
        'preset',
        'published'
    ];

    protected $attribute = [
        'published' => true,
    ];

    public function Prices()
    {
        return $this->hasMany(Price::class, 'item_category_id');
    }
    public function Expenses()
    {
        return $this->hasManyThrough('Modules\ExpenseManagement\Entities\Expense', Price::class)->where('expenses.status', 'Approved');
    }
    public function Requisitions()
    {
        return $this->hasManyThrough('Modules\ExpenseManagement\Entities\Expense', Price::class)->where('expenses.status', 'Scheduled');
    }
    public function Account()
    {
        return $this->morphOne('Modules\AccountManagement\Entities\Account', 'accountable');
    }
    public function TotalExpenses()
    {
        return $this->Expenses()->sum('amount');
    }
    public function getSummaryAttribute()
    {
        return Str::limit($this->overview, $limit = 20, $end = '...');
    }
    public function scopeActive($query)
    {
        return $query->where('published', true);
    }
}
