<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\CatalogManagement\Entities\Program;
use Modules\CatalogManagement\Entities\Cause;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Modules\CatalogManagement\Traits\CauseTrait;
use Session;

class CauseController extends Controller
{
    use CauseTrait;
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
        $causes = Cause::active()->get();
        return view ('catalogmanagement::causes.index', compact('causes', 'page'));
    }

    public function display($slug)
    {
        $cause = Cause::details($slug);
        $allcauses = Cause::active()->get();
        return view ('catalogmanagement::causes.display', compact('cause', 'allcauses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $causes = Cause::all();
        return view('catalogmanagement::causes.create', compact('causes'));
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
        if ( !$this->saveCause()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->route('causes.show', $this->cause->slug)->with('success','Cause Added Successfully.');
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'cause_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->cause = Cause::findorFail($request->cause_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->cause->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function changethumb(Request $request)
    {
        //
        $this->validate($request, [
            'cause_id' => 'required',
            'thumbnail' => 'required',
            'thumbnail.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->cause = Cause::findorFail($request->cause_id);
        if ($request->hasFile('thumbnail')) {
            $this->thumbnail = $request->file('thumbnail');
            $this->saveThumbnail() ;
            $this->cause->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function toggle(Cause $cause)
    {
        if ($cause->enabled == true) {
            $cause->enabled = false;
            $feedback = $cause->label. ' Disabled successfully';
        } else {
            $cause->enabled = true;
            $feedback = $cause->label. 'Enabled successfully';
        }
        if ( ! $cause->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function programslist(Request $request)
    {
        $programs = Program::active($request->cause)->pluck("label","id");
        return response()->json($programs);
    }

    public function manage()
    {
        //
        $causes = Cause::all();
        return view ('catalogmanagement::causes.manage', compact('causes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function show(Cause $cause)
    {
        //
        return view('catalogmanagement::causes.show',compact('cause'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function edit(Cause $cause)
    {
        //
        return view('catalogmanagement::causes.edit',compact('cause'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cause $cause)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required',
        ]);

        if ( !$cause->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error Updating cause.');
        }
       return redirect()->route('causes.show', $cause)->with('success','Cause Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cause $cause)
    {
        //
        $cause->delete();
        return redirect()->back()->with('success','Cause deleted successfully');
    }
}
