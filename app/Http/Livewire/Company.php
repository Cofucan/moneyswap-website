<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;

class Company extends Component
{
    public $registration_number;
    public $legal_name;
    public $short_name;
    public $slug;
    public $organizations, $organization_id;
    public $updateOrganization = false;

    protected $listeners = [
        'deleteOrganization'=>'destroy'
    ];

    // Validation Rules
    protected $rules = [
        'short_name'=>'required',
        'legal_name'=>'required'
    ];

    public function render()
    {
        $this->organizations = Organization::select('id','short_name','legal_name')->get();
        return view('livewire.company');
    }

    public function resetFields(){
        $this->short_name = '';
        $this->legal_name = '';
        $this->registration_number = null;
    }

    public function store(){

        // Validate Form Request
        $this->validate();

        try{
            // Create Organization
            Organization::create([
                'registration_number'=>$this->registration_number,
                'short_name'=>$this->short_name,
                'legal_name'=>$this->legal_name
            ]);

            // Set Flash Message
            session()->flash('success','Organization Created Successfully!!');

            // Reset Form Fields After Creating Organization
            $this->resetFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating organization!!');

            // Reset Form Fields After Creating Organization
            $this->resetFields();
        }
    }

    public function edit($id){
        $organization = Organization::findOrFail($id);
        $this->short_name = $organization->short_name;
        $this->legal_name = $organization->legal_name;
        $this->registration_number = $organization->registration_number;
        $this->organization_id = $organization->id;
        $this->updateOrganization = true;
    }

    public function cancel()
    {
        $this->updateOrganization = false;
        $this->resetFields();
    }

    public function update(){

        // Validate request
        $this->validate();

        try{

            // Update organization
            Organization::find($this->organization_id)->fill([
                'registration_number'=>$this->registration_number,
                'short_name'=>$this->short_name,
                'legal_name'=>$this->legal_name
            ])->save();

            session()->flash('success','Organization Updated Successfully!!');

            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating organization!!');
            $this->cancel();
        }
    }

    public function destroy($id){
        try{
            Organization::find($id)->delete();
            session()->flash('success',"Organization Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting organization!!");
        }
    }
}
