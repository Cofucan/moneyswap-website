<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document as documents;
use App\Models\DocumentType;
class Document extends Component
{
    use WithFileUploads;

    public $id_code;
    public $profile_id;
    public $document_type_id;
    public $selectedDocumentType = null;
    public $id_path;

    public function submit()
    {
        $data = $this->validate([
            'id_code' => 'required',
            'profile_id' => 'required',
            'document_type_id' => 'required',
            'id_path' => 'required',
        ]);
        $filename = $this->id_path->store('documents','public');
        $data['id_path'] = $filename;
        Document::create($data);
        session()->flash('message', 'Document uploaded and awaiting verification.');
        return redirect()->to('/home');
    }
    public function mount()
    {
        $this->documenttype = DocumentType::active()->get();
    }
    public function render()
    {

        return view('livewire.document');
    }
}
