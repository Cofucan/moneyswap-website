<?php

namespace App\Http\Livewire\MailVariable;

use App\Models\MailVariable;
use Livewire\Component;
use Livewire\WithPagination;

class ListMailVariable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $reload = false;

    public function deleteVariable($id)
    {
        MailVariable::find($id)->delete();

        $this->reload = true;

        session()->flash('success', 'Mail variable deleted with success!');
    }

    public function render()
    {
        return view('livewire.mail-variable.list-mail-variable', [
            'allVariables' => MailVariable::paginate(10)
        ]);
    }
}
