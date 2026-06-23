<?php

namespace Modules\OrganizationManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\OrganizationManagement\Entities\Industry;
use Modules\ContentManagement\Entities\Page;
use Modules\OrganizationManagement\Traits\IndustryTrait;
use Illuminate\Http\Request;
use Session;

class IndustryController extends Controller
{
    use IndustryTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         //
         $page_tag = 'our-industries';
         $page = Page::where('page_tag', $page_tag)->first();
         $industries = Industry::active()->get();
        return view('organizationmanagement::industries.index', compact( 'industries', 'page'));
     }

     public function details($slug)
     {
         $industry = Industry::where('slug', $slug)->first();
         //$expertises = Expertise::active()->get();
         return view ('organizationmanagement::industries.details', compact('industry'));
     }


    public function manage()
    {
        //
        $industries = Industry::all();
        return view('organizationmanagement::industries.manage', compact('industries'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('organizationmanagement::industries.create');
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
        $request->validate([
            'label' => 'required',
            'overview' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:2000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if ( !$this->saveIndustry()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
        return redirect()->back()->with('success','Industry Added successfully.');
    }
    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'industry_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->industry = Industry::findorFail($request->industry_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->industry->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function changethumb(Request $request)
    {
        //
        $this->validate($request, [
            'industry_id' => 'required',
            'thumbnail' => 'required',
            'thumbnail.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->industry = Industry::findorFail($request->industry_id);
        if ($request->hasFile('thumbnail')) {
            $this->thumbnail = $request->file('thumbnail');
            $this->saveThumbnail() ;
            $this->industry->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function toggle(Industry $industry)
    {
        if ($industry->enabled == 1) {
            $industry->enabled = 0;
            $feedback = 'Industry Unpublished successfully';
        } else {
            $industry->enabled = 1;
            $feedback = 'Industry Published successfully';
        }
        if ( ! $industry->save()) {
            return redirect()->back()->with('error', 'Could not update Industry');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function show(Industry $industry)
    {
        //
        return view('organizationmanagement::industries.show',compact('industry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function edit(Industry $industry)
    {
        //
        return view('organizationmanagement::expertises.edit',compact('industry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Industry $industry)
    {

        //dd($request->all());
        $request->validate([
            'label' => 'required',
        ]);
        if( ! $industry->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Industry Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Industry $industry)
    {
        //
        $industry->delete();
        return redirect()->back()->with('success','Industry deleted successfully');
    }
}
