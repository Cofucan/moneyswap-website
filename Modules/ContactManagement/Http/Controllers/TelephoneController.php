<?php

namespace Modules\ContactManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContactManagement\Entities\Telephone;
use Modules\ContactManagement\Traits\TelephoneTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class TelephoneController extends Controller
{
use TelephoneTrait;
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
            'telephone' => 'required',
            'phone_tag' => 'required'
        ]);
        $this->data = $request->all();
        if ( ! $this->saveTelephone()) {
                return redirect()->back()->withInput()->withErrors('something went wrong, please check your entry and try again');
            }
        return redirect()->back()->with('success','Telephone Added successfully.');
    }
   

    public function manage()
    {
        //
        $telephones = Telephone::all();       
        return view ('contactmanagement::telephones.manage', compact('telephones') );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Telephone $telephone)
    {
        //
        return view('contacts.show',compact('telephone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Telephone $telephone)
    {
        //
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Telephone $telephone)
    {
        //
        $this->validate($request, [

            'phone_number' => 'required',

        ]);
        if( ! $telephone->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Telephone Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telephone $telephone)
    {
        //
        $telephone->delete();
         return redirect()->back()
                         ->with('success','telephone deleted successfully');
    }
}
