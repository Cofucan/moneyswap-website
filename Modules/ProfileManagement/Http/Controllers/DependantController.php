<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\Dependant;
use Illuminate\Http\Request;

class DependantController extends Controller
{
    public function saveDependant()
    {
        if(isset($this->data['dependant_id']) || isset($this->dependant_id)){         
            $this->dependant = Dependant::findorFail(!empty($this->data['dependant_id']) ? $this->data['dependant_id'] : $this->dependant_id);
          
        }else{
            $this->dependant = new Dependant;   
            $this->dependant->profile_id = !empty($this->data['profile_id']) ? $this->data['profile_id'] : $this->profile_id;         
        }
        $this->dependant->relationship = $this->data['relationship'];
        $this->dependant->person_id = $this->data['person_id'];
        $this->dependant->email = !empty($this->data['email']) ? $this->data['email'] : '';
        $this->dependant->telephone = !empty($this->data['telephone']) ? $this->data['telephone'] : '';
        $this->dependant->published = !empty($this->data['published']) ? $this->data['published'] : '1';             
        if(!is_null($this->data['address_id']))
        {
            $this->dependant->address_id = $this->data['address_id'];
        }

        
        if ( ! $this->dependant->save()) {           
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->dependant;
    }

    public function manage()
    {
        //
        $dependants = Dependant::with('Profile', 'Person')->get();
        return view ('dependants.manage', compact('dependants'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dependants = Dependant::with('Profile', 'Person')->get();
        return view ('dependants.index', compact('dependants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employees = Employee::with('Profile', 'Designation')->whereEmployeeCategoryId('1')->get();
        return view('dependants.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'relationship' => 'required'      
        ]);
        
        $this->data = $request->all();
        if($this->saveDependant())
        {
            return redirect()->route('dependants.show', $this->dependant->id)->with('success','Dependant Added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependant  $dependant
     * @return \Illuminate\Http\Response
     */
    public function show(Dependant $dependant)
    {
        //
        return view('dependants.show',compact('dependant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dependant  $dependant
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependant $dependant)
    {
        //
        $employees = Employee::with('Profile', 'Designation')->whereEmployeeCategoryId('1')->get();
        return view('dependants.edit',compact('dependant', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependant  $dependant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependant $dependant)
    {
        //
        $this->validate($request, [
            'relationship' => 'required'
        ]);
        $this->dependant_id = $dependant->id;
        $this->data = $request->all();
        if($this->saveDependant())
        {
            return redirect()->route('dependants.show', $this->dependant->id)->with('success','Dependant updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependant  $dependant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependant $dependant)
    {
        //
        $dependant->delete();
        return redirect()->back()
                        ->with('success','Dependant deleted successfully');
    }
}
