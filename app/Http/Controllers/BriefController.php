<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Modules\CatalogManagement\Entities\Expertise;
use App\Models\City;
use App\Models\Neighbourhood;
use Illuminate\Http\Request;
use Auth;
use Session;

class BriefController extends Controller
{
    
    public function saveBrief()
    {
        $expertise = Expertise::findorFail($data['expertise_id']);
        $brief = new Brief;
        $brief->device_ip = $request->getClientIp();
        // $brief->currency =  $data['currency'];
        // $brief->budget =  $data['budget'];
        // $brief->neighbourhood_id =  $data['neighbourhood_id'];
        // $brief->contract_type =  $data['contract_type'];
        $brief->contact_name =  $data['contact_name'];
        $brief->email =  $data['email'];
        $brief->telephone =  $this->data['telephone'];

        if(isset($this->data['brief_details']))
        {
            $this->brief->brief_details = $this->data['brief_details'];
        }

        if(!isset($this->data['country_code'])){
            $this->brief->telephone ='+234'.substr($this->data['telephone'],-10);
        }else{
            $this->brief->telephone = $data['country_code'].substr($this->data['telephone'],-10);
        }

        if(!isset($this->data['brief_subject'])){
            $this->brief->brief_subject = ' Quote Required for '. $this->expertise->expertise_title;
        }else{
            $this->brief->brief_subject = $this->data['brief_subject'];
        }

        if ( ! $this->expertise->Briefs()->save($this->brief)) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->brief;
    }
    // public function manage()
    // {
    //     $briefs = Brief::where('email', Auth::user()->email);
    //     return view('briefs.manage', compact('briefs'));
    // }
    public function manage()
    {
        $briefs = Brief::all();
        return view('briefs.manage', compact('briefs'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $briefs = Brief::all()->orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
            });
            return view('briefs.index', compact('briefs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //      
         
        return view('briefs.create', );
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
        //dd($request->all());
        $this->validate($request, [
          
            'contact_name' => 'required',
            'telephone' => 'required',
            'email' => 'required',          
            'expertise_id' => 'required',
           
        ]);
        $data = $request->all();      
        if($this->saveBrief())
        {
            return redirect()->back()->with('success','Request Sent successfully. A service rep will respond to your request as soon as possible.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brief  $brief
     * @return \Illuminate\Http\Response
     */
    public function show(Brief $brief)
    {
        //
        return view('briefs.show',compact('brief'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brief  $brief
     * @return \Illuminate\Http\Response
     */
    public function edit(Brief $brief)
    {
        //
        $contractTypes = $this->contractTypes;
        $expertises = $this->expertises;
        $neighbourhoods = $this->neighbourhoods;
        return view('briefs.edit', compact('brief', 'contractTypes', 'expertises', 'neighbourhoods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brief  $brief
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brief $brief)
    {
        //
        $this->validate($request, [
            'budget' => 'required',
            'contact_name' => 'required',
            'phone' => 'required',
            'telephone' => 'required',
            'neighbourhood_id' => 'required',
            'expertise_id' => 'required',
            'contract_type' => 'required'
        ]);
        $this->data = $request->all();
        $this->brief = Brief::findorFail($request->brief->id);
        if($this->saveBrief())
        {
            return redirect()->route('briefs.show', $this->brief->id)->with('success','Brief Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brief  $brief
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brief $brief)
    {
        //
        $brief->delete();
        return redirect()->route('briefs.manage')
                        ->with('success','Brief deleted successfully');
    }
}
