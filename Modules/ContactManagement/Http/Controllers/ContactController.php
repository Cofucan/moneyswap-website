<?php

namespace Modules\ContactManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContactManagement\Entities\Contact;
use Modules\ClientManagement\Entities\Outlet;
use Modules\ProfileManagement\Entities\Person;
use Modules\ClientManagement\Entities\Organization;
use Modules\ProfileManagement\Entities\Profile;
use Modules\SchoolManagement\Entities\School;
use Modules\ContactManagement\Entities\ContactType;
use Modules\ContactManagement\Traits\ContactTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class ContactController extends Controller
{
use ContactTrait;
    public function __construct()
    {

        

    }

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
        $contactTypes = ContactType::all()->pluck("contact_type");

        $contactTags = $this->contactTags;
        return view ('contactmanagement::contacts.create', compact('contactTypes', 'contactTags'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'telephone' => 'required',
        ]);
        $this->data = $request->all();
        if ( ! $this->saveContact()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
        return redirect()->back()->with('success','Contact Added successfully.');
    }
    public function changestatus(Request $request, Contact $contact)
    {
        $contact = Contact::findOrFail($request->id);
        if ($contact->published == 1) {
            $contact->published = 0;
            $published = 'Not Published';
        } else {
            $contact->published = 1;
            $published = 'Published';
        }
        if ( ! $contact->save()) {
            Session::flash('error', 'Record status could not be changed.');
            return redirect()->route('managePages');
        }
        Session::flash('success', 'Status has been updated successfully '.$published);
        return redirect()->route('managePages');
    }

    public function manage()
    {
        //
        $contacts = Contact::all();
        // foreach($contacts as $contact)
        // {
        //     if($contact->contact_type == 'Email')
        //     {
        //         $profile = $contact->Profile();
        //         //
        //         if(!empty($profile))
        //         {
        //             $profile->email = $contact->contact_value;
        //         //dd($profile->email);
        //         if($profile->save())
        //         {
        //             $contact->delete();
        //         }
        //         }

        //     }
        // }
        return view ('contactmanagement::contacts.manage', compact('contacts') );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        $contactableTypes = $this->contactableTypes;
        $contactTypes = $this->contactTypes;
        $contactTags = $this->contactTags;
         return view('contacts.edit',compact('contact', 'contactableTypes', 'contactTypes', 'contactTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $this->validate($request, [

            'telephone' => 'required',

        ]);
        if( ! $contact->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Contact Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();
         return redirect()->back()
                         ->with('success','Contact deleted successfully');
    }
}
