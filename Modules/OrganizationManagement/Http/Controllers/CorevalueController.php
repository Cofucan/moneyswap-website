<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\OrganizationManagement\Entities\Corevalue;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use Session;
use Image;
use File;

class CorevalueController extends Controller
{
    public function __construct()
    {
       
        
    }
    public function SaveCorevalues()
    {
        if(isset($this->data['corevalue_id']) || isset($this->corevalue_id)){         
            $this->corevalue = Corevalue::findorFail(!empty($this->data['corevalue_id']) ? $this->data['corevalue_id'] : $this->corevalue_id);
          
        }else{
            $this->corevalue = new Corevalue;   
            $this->corevalue->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : $this->organization_id;
         
        }
        $this->corevalue->value_title = $this->data['value_title'];
        // $this->corevalue->display_image = $this->data['display_image'];
        $this->corevalue->summary = !empty($this->data['summary']) ? $this->data['summary'] : '';
        $this->corevalue->display_order = !empty($this->data['display_order']) ? $this->data['display_order'] : '1';              
        $this->corevalue->published = !empty($this->data['published']) ? $this->data['published'] : '1';             
        if(isset($this->display_image))
        {
            $this->saveDisplayImage() ;
        }
        if ( ! $this->corevalue->save()) {           
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->corevalue;
    }

    public function saveDisplayImage()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/corevalues/')) {
                $person_img = File::makeDirectory('images/corevalues', 0777, true);
            }
            $filename = Str::slug($this->corevalue->value_title).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
            $display_image_url = 'images/corevalues/' . $filename;
            $this->corevalue->display_image     = $display_image_url;
            // upload image to server
            Image::make($this->display_image)->save($display_image_url);

    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $corevalue = Corevalue::with('School')->whereSchoolId(session::get('organization_id'))->first();
        return view('organizationmanagement::corevalues.index', compact('corevalue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('organizationmanagement::corevalues.create');
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
            'organization_id' => 'required',
            'value_title' => 'required',
            // 'summary' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);        
        $this->data = $request->all();       
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if(!$this->SaveCorevalues())
        {
        return redirect()->back()->with('error','Corevalue Added successfully.');
             
        }
        return redirect()->back()->with('success','Corevalue Added successfully.');
    }

    public function toggle(Corevalue $corevalue)
    {
        if ($corevalue->published == 1) {
            $corevalue->published = 0; 
            $feedback = 'Core Value Unpublished successfully';        
        } else {
            $corevalue->published = 1;
            $feedback = 'Core Value Published successfully';
        }
        if ( ! $corevalue->save()) {
            return redirect()->back()->with('error', 'Something went wrong, could not create Value');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corevalue  $corevalue
     * @return \Illuminate\Http\Response
     */
    public function show(Corevalue $corevalue)
    {
        //
        return view('corevalues.show',compact('corevalue'));
    }

    public function manage()
    {
    $corevalues = Corevalue::with('School')->get();
    return view('organizationmanagement::corevalues.manage', compact('corevalues'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corevalue  $corevalue
     * @return \Illuminate\Http\Response
     */
    public function edit(Corevalue $corevalue)
    {
        //      
        
        return view('organizationmanagement::corevalues.edit',compact('corevalue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corevalue  $corevalue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corevalue $corevalue)
    {
        //
        $this->validate($request, [           
            'value_title' => 'required',
            'summary' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        // $this->data = $request->all();
        if(isset($this->display_image))
        {
            $this->saveDisplayImage() ;
        }
        if($corevalue->update($request->all()))
        {
            return redirect()->back()->with('success','Corevalue Updated successfully.');
        }       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corevalue  $corevalue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corevalue $corevalue)
    {
        //
        $corevalue->delete();
        return redirect()->back()
                        ->with('success','Core value deleted successfully');
    }
}
