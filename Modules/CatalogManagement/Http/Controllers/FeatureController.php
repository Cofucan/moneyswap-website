<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\CatalogManagement\Entities\Feature;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Modules\CatalogManagement\Traits\FeatureTrait;
use Session; 

class FeatureController extends Controller
{
    use FeatureTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'features';
        $page = Page::where('page_tag', $page_tag)->first();
        $features = Feature::all ();
        return view ('catalogmanagement::features.index', compact('features', 'page'));
    }

    public function feature($slug)
    {
        $feature = Feature::where('slug', $slug)->first();
        return view ('catalogmanagement::features.feature', compact('feature'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $features = Feature::all();
        return view('catalogmanagement::features.create', compact('features'));
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
            'overview' => 'required'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if ( !$this->saveFeature()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->route('features.show', $this->feature->slug)->with('success','Feature Added Successfully.');
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'feature_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->feature = Feature::findorFail($request->feature_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->feature->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function changethumb(Request $request)
    {
        //
        $this->validate($request, [
            'feature_id' => 'required',
            'icon' => 'required',
            'icon.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->feature = Feature::findorFail($request->feature_id);
        if ($request->hasFile('icon')) {
            $this->icon = $request->file('icon');
            $this->saveIcon() ;
            $this->feature->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function toggle(Feature $feature)
    {
        if ($feature->enabled == true) {
            $feature->enabled = false;
            $feedback = $feature->label. ' Disabled successfully';
        } else {
            $feature->enabled = true;
            $feedback = $feature->label. 'Enabled successfully';
        }
        if ( ! $feature->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

   

    public function manage()
    {
        //
        $features = Feature::all ();
        return view ('catalogmanagement::features.manage' )->withFeatures($features);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
        return view('catalogmanagement::features.show',compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        //
        return view('catalogmanagement::features.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required',
        ]);

       
        if ( !$feature->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error Updating service.');
        }
       return redirect()->route('features.show', $feature)->with('success','Service Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        //
        $feature->delete();
        return redirect()->back()->with('success','Feature deleted successfully');
    }
}
