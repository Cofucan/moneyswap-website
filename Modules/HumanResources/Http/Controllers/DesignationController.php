<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\HumanResources\Entities\Designation;
use Modules\ClientManagement\Entities\Department;
use Illuminate\Http\Request;
use Session;

class DesignationController extends Controller
{
    public function __construct()
    {
        //$this->designations = Designation::all()->pluck("designation", "id");
        //$this->roles = Role::all()->pluck("label", "id");
       // $this->departments= Department::where('published',true)->pluck("label", "id");
    }

    public function saveDesignation()
    {
        $this->designation = new Designation;
        $this->designation->role_id = !empty($this->data['role_id']) ? $this->data['role_id'] : $this->role_id;
        // $this->designation->role_id = !empty($this->data['role_id']) ? $this->data['role_id'] : $this->role_id;
        $this->designation->job_role = $this->data['job_role'];
        $this->designation->job_description = !empty($this->data['job_description']) ? $this->data['job_description'] : '';
        $this->designation->responsibilities = !empty($this->data['responsibilities']) ? $this->data['responsibilities'] : '';
        $this->designation->parent_id = !empty($this->data['parent_id']) ? $this->data['parent_id'] : '0';
        $this->designation->published = !empty($this->data['published']) ? $this->data['published'] : '1';
        if ( ! $this->designation->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->designation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $parents = Designation::pluck("job_role", "id");
        $departments = Department::where('published',true)->pluck("label", "id");;
        $designations = Designation::with('Role')->get();
        return view('humanresources::designations.index', compact('designations', 'departments', 'parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $designations = Designation::all()->pluck("job_role", "id");
        $departments = Department::where('published',true)->orderBy('label', 'ASC')->pluck("label", "id");
        return view('humanresources::designations.create', compact( 'designations', 'departments'));
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
            'job_role' => 'required',
            'role_id' => 'required',
            'job_description' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->saveDesignation()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
       return redirect()->route('designations.show', $this->designation->id)->with('success','Designation Added successfully.');

    }

    public function toggle(Designation $designation)
    {
        if ($designation->published == 1) {
            $designation->published = 0;
            $feedback = 'Designation Unpublished successfully';
        } else {
            $designation->published = 1;
            $feedback = 'Designation Published successfully';
        }
        if ( ! $designation->save()) {
            return redirect()->back()->with('error', 'Could not update Department');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
        $parents = Designation::pluck("job_role", "id");
        return view('humanresources::designations.show',compact('designation', 'parents'));
    }

    public function manage()
    {
        $designations = Designation::with('Department', 'Role')->get();
        return view('humanresources::designations.manage', compact('designations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
        $parents = Designation::pluck("job_role", "id");
        // $parents = Designation::where('role_id', $designation->role_id)->pluck("designation", "id");
        return view('humanresources::designations.edit', compact('designation', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        //
        $this->validate($request, [
            'job_role' => 'required',
            'job_description' => 'required'
        ]);
        if ( ! $designation->update($request->all())) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        return redirect()->route('designations.show', $designation->id)->with('success','Designation Updated  successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        //
        $designation->delete();
        return redirect()->back()
                        ->with('success','Admission Requirement deleted successfully');

    }
}
