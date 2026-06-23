<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\OrganizationManagement\Entities\Organization;
use Modules\OrganizationManagement\Traits\OrganizationTrait;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    use OrganizationTrait;
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
        $industries = $this->IndustriesList();
        return view('organizationmanagement::organizations.create', compact('industries'));
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
            'organization_name' => 'required',
            'official_logo.*' => 'image|mimes:jpeg,jpg,png,gif|max:500'
        ]);
        $this->data = $request->all();
        
        if ($request->hasFile('official_logo')) {
            $this->official_logo = $request->file('official_logo');
        }
        if($this->saveOrganization())
        {
            if(isset($this->data['industry_id'])){
                $this->IndustryOrganization();
            }
            return redirect()->route('organizations.show', $this->organization->id)->with('success','organization has been created successfully');
        }
    }

    public function autocomplete(Request $request)
    {
        $data = Organization::select("organization_name")
                ->where("organization_name","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    }

    public function manage()
    {
        //
        $organizations = Organization::with('Page', 'Industry')->get();
        return view('organizationmanagement::organizations.manage', compact('organizations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        $organization->load('Outlets.City');
        return view('organizationmanagement::organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
        $industries = $this->IndustriesList();
        return view('organizationmanagement::organizations.edit', compact('organization','industries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
        $this->validate($request, [
            // 'about' => 'required',
            'official_logo.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000',
            'favicon.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        if ($request->hasFile('official_logo')) {
            $this->official_logo = $request->file('official_logo');
            $this->saveLogo() ;
            // $this->organizati->save();
        }
        if ($request->hasFile('official_logo')) {
            $this->favicon = $request->file('favicon');
            $this->saveIcon() ;
            // $this->organizati->save();
        }
        if( ! $organization->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        } 
        return redirect()->back()->with('success','organization Record Updated Successfully.');
        
    }

    public function saveLogo()
    {
             // create new directory for uploading image if doesn't exist
        // $organization = Organization::findorFail($this->organization->id);
         if ( ! File::exists('images/icons')) {
             $organization_image = File::makeDirectory('images/icons', 0777, true);
         }
         $filename = Str::slug($organization->organization_name).'_'.time().'.'.$this->logo->getClientOriginalExtension();
         $organization_image = 'images/icons' . $filename;
         $organization->official_logo     = $organization_image;
         // upload image to server
         Image::make($this->official_logo)->fit('235', '100', function ($constraint) {
             $constraint->upsize();
         })->save($organization_image);
 
    }

    public function saveIcon()
    {
             // create new directory for uploading image if doesn't exist
        // $organization = Organization::findorFail($this->organization->id);
         if ( ! File::exists('images/icons')) {
             $organization_icon = File::makeDirectory('images/icons', 0777, true);
         }
         $filename = Str::slug($organization->organization_name).'_'.time().'.'.$this->logo->getClientOriginalExtension();
         $organization_icon = 'images/icons' . $filename;
         $organization->favicon     = $organization_icon;
         // upload image to server
         Image::make($this->favicon)->fit('235', '100', function ($constraint) {
             $constraint->upsize();
         })->save($organization_icon);
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
        $organization->delete();
        return redirect()->back()
                        ->with('success','Organization deleted successfully');
    }
}
