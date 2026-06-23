<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ProfileManagement\Entities\ProfileAddress;
use Modules\ClientManagement\Entities\Organization;
use Modules\ProfileManagement\Entities\Profile;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class ProfileAddressController extends Controller
{
use ProfileTrait;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $addressTypes = [           
            'Work' => 'Work',
            'Home' => 'Home'
        ];
        return view('profilemanagement::profileaddresses.create', compact('addressTypes'));
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
            'address_type' => 'required',
            'profile_id' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->saveProfileAddress()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }        
        return redirect()->back()->with('success','Contact Added successfully.');
    }
   

    public function manage()
    {
        //
       
       
        return view('profilemanagement::profileaddresses.manage' )->withContacts($profileaddresss);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $profileaddress
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileAddress $profileaddress)
    {
        //
        return view('profilemanagement::profileaddresses.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $profileaddress
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileAddress $profileaddress)
    {
        //
      
         return view('profilemanagement::profileaddresses.edit',compact('contact', 'contactableTypes', 'contactTypes', 'contactTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $profileaddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileAddress $profileaddress)
    {
        //
        $this->validate($request, [
            
            'contact_value' => 'required',
          
        ]);
        if( ! $profileaddress->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        } 
        return redirect()->back()->with('success','Contact Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $profileaddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileAddress $profileaddress)
    {
        //
        $profileaddress->delete();
         return redirect()->back()
                         ->with('success','Contact deleted successfully');
    }
}
