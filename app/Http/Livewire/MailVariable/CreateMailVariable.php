<?php

namespace App\Http\Livewire\MailVariable;

use App\Models\MailVariable;
use Livewire\Component;

class CreateMailVariable extends Component
{
    public $variableKey = "";
    public $variableValue = "";

    public $itemId = null;

    protected $listeners = ['showCreateModal', 'closeCreateModal', 'showCreateModalForUpdate'];

    public $showModal = false;

    protected function rules()
    {
        return [
            'variableKey' => 'required|unique:mail_variables,variable_key' . ($this->itemId ? ',' . $this->itemId : '')
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        if(!$this->itemId) {
            $mailVariable = new MailVariable();
        } else {
            $mailVariable = MailVariable::find($this->itemId);
        }

        $mailVariable->variable_key = $this->variableKey;
        $mailVariable->variable_value = $this->variableValue;
        $mailVariable->save();

        session()->flash('success', 'Variable saved with success!');

        return redirect()->to('/mail-variable');
    }

    public function showCreateModal()
    {
        $this->reset('itemId', 'variableKey', 'variableValue');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->itemId = null;

        $this->showModal = true;
    }

    public function showCreateModalForUpdate($id)
    {
        $this->reset('itemId', 'variableKey', 'variableValue');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->itemId = $id;

        $mailVariable = MailVariable::find($id);
        $this->variableKey = $mailVariable->variable_key;
        $this->variableValue = $mailVariable->variable_value;

        $this->showModal = true;
    }

    public function closeCreateModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.mail-variable.create-mail-variable');
    }
}
