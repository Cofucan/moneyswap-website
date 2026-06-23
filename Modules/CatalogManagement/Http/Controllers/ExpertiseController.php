<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\CatalogManagement\Entities\Expertise;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Modules\CatalogManagement\Traits\ExpertiseTrait;
use Session; 

class ExpertiseController extends Controller
{
    use ExpertiseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'what-we-do';
        $page = Page::where('page_tag', $page_tag)->first();
        $expertises = Expertise::all ();
        return view ('catalogmanagement::expertises.index', compact('expertises', 'page'));
    }

    public function expertise($slug)
    {
        $expertise = Expertise::where('slug', $slug)->first();
        return view ('catalogmanagement::expertises.expertise', compact('expertise'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $expertises = Expertise::all();
        return view('catalogmanagement::expertises.create', compact('expertises'));
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
        if ( !$this->saveExpertise()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->route('expertises.show', $this->expertise->slug)->with('success','Expertise Added Successfully.');
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'expertise_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->expertise = Expertise::findorFail($request->expertise_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->expertise->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function changethumb(Request $request)
    {
        //
        $this->validate($request, [
            'expertise_id' => 'required',
            'thumbnail' => 'required',
            'thumbnail.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->expertise = Expertise::findorFail($request->expertise_id);
        if ($request->hasFile('thumbnail')) {
            $this->thumbnail = $request->file('thumbnail');
            $this->saveThumbnail() ;
            $this->expertise->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function toggle(Expertise $expertise)
    {
        if ($expertise->enabled == true) {
            $expertise->enabled = false;
            $feedback = $expertise->label. ' Disabled successfully';
        } else {
            $expertise->enabled = true;
            $feedback = $expertise->label. 'Enabled successfully';
        }
        if ( ! $expertise->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

   

    public function manage()
    {
        //
        $expertises = Expertise::all ();
        return view ('catalogmanagement::expertises.manage' )->withExpertises($expertises);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function show(Expertise $expertise)
    {
        //
        return view('catalogmanagement::expertises.show',compact('expertise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function edit(Expertise $expertise)
    {
        //
        return view('catalogmanagement::expertises.edit',compact('expertise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expertise $expertise)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required',
        ]);

       
        if ( !$expertise->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error Updating service.');
        }
       return redirect()->route('expertises.show', $expertise)->with('success','Service Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expertise $expertise)
    {
        //
        $expertise->delete();
        return redirect()->back()->with('success','Expertise deleted successfully');
    }
}
