<?php

namespace Modules\RoleManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\RoleManagement\Entities\Role;
use App\Models\User;
use Modules\ClientManagement\Entities\Department;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getuserlist(Request $request)
    {
        $this->role_id = $request->role;
        $users = User::with('Profile')
                ->whereHas('Profile', function($query){
                    $query->where('role_id', $this->role_id);
                    })
                ->get()
                ->pluck("Profile.name","id");
        return response()->json($users);
    }


    public function index()
    {
        //
        $departments = Department::where('published',true)->orderBy('label', 'ASC')->pluck("label", "id");
        $roles = Role::all();
        return view('rolemanagement::roles.index', compact( 'roles', 'departments'));
    }

    public function manage()
    {
        //
        $departments = Department::where('published',true)->orderBy('label', 'ASC')->pluck("label", "id");
        $roles = Role::all();
        return view('rolemanagement::roles.manage', compact('roles', 'departments'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rolemanagement::roles.create');
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
            'label' => 'required',
            'department_id' => 'required',
            'overview' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->saveRole()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

       return redirect()->back()->with('success','Role Added successfully.');

    }

    public function saveRole()
    {
        $this->role = new Role;
        $this->role->department_id = !empty($this->data['department_id']) ? $this->data['department_id'] : $this->department_id;
        $this->role->label = $this->data['label'];
        $this->role->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->role->default_role = !empty($this->data['default_role']) ? $this->data['default_role'] : '0';
        $this->role->published = !empty($this->data['published']) ? $this->data['published'] : '1';
        if ( ! $this->role->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->role;
    }

    public function toggle(Role $role)
    {
        if ($role->published == 1) {
            $role->published = 0;
            $feedback = 'Role Unpublished successfully';
        } else {
            $role->published = 1;
            $feedback = 'Role Published successfully';
        }
        if ( ! $role->save()) {
            return redirect()->back()->with('error', 'Could not update Role');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        return view('rolemanagement::roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        //dd($request->all());
        $request->validate([
            'label' => 'required',
        ]);
        if( ! $role->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Role Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        return redirect()->back()->with('success','Role deleted successfully');
    }
}
