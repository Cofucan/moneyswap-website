<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cause;
use App\Models\Currency;
use App\Models\Bank;
use App\Models\Fee;
use Auth;
class Swap extends Component
{
    public $causes;
    public $banks;
    public $currencies;
    public $swap_amount;
    public $swap_rate;
    public $swap_fee;
    public $swapCurrency;
    public $amount_due;
    public $selectedWalletCurrency = null;
    public $selectedSwapCurrency = null;
    public $providedSwapAmount = null;

    public function mount($providedSwapAmount = null)
    {
        $this->currencies = Currency::active()->get();
        $this->causes = Cause::all();
        $this->banks = Bank::all();
        //$this->causes = Auth::user()->Member->causes();

        $this->providedSwapAmount = $swap_amount;

        if (!is_null($providedSwapAmount)) {
            $fee = Fee::purpose('swap')->first();
            if ($fee) {
                $this->swap_fee = $fee->applicable($this->swap_amount);
                $this->amount_due = $swap_amount+$this->swap_fee;
                $this->equivalent_value = $this->amount_due*$swap_rate;
                $this->swapCurrency = Currency::find($selectedSwapCurrency)->code;
            }
        }
    }
    public function render()
    {
        return view('livewire.swap');
    }
    public function updatedSelectedWalletCurrency($country)
    {
        $this->currencies = State::where('country_id', $country)->get();
        $this->selectedSwapCurrency = NULL;
    }

    public function updatedSelectedSwapCurrency($state)
    {
        if (!is_null($state)) {
            $this->cities = City::where('state_id', $state)->get();
        }
    }
}
