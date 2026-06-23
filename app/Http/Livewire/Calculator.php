<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Currency;
class Calculator extends Component
{
    public $currencies;
    public $swap_amount;
    public $source_currency;
    public $swap_currency;
    public $swap_value;

    public $selectedSourceCurrency = null;
    public $selectedSwapCurrency = null;
    public $providedSwapAmount = null;


    public function mount()
    {
        $this->currencies = Currency::active()->get();
        $this->cities = collect();
    }

    public function render()
    {
        return view('livewire.calculator');
        //return view('livewire.statecitydropdown')->extends('layouts.app');
    }

    public function updatedSelectedState($currency)
    {
        if (!is_null($currency)) {
            $this->cities = DemoCity::where('state_id', $currency)->get();
        }
    }
}
