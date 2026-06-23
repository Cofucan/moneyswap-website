<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Classification;
use Illuminate\Http\Request;
use Modules\ContentManagement\Traits\PostTrait;

class ClassificationController extends Controller
{
    use PostTrait;
    public function detachPost(Request $request)
    {
        $this->validate($request, [
            'classification_id' => 'required',
            'post_id' => 'required'
        ]);
        $classification = Classification::find($request->classification_id);
        if($classification->Posts()->detach($request->post_id))
        {
            return redirect()->back()->with('success','Post removed from Category successfully.');
        }
    }

    public function empty(Classification $classification)
    {
        if($classification->Posts()->detach())
        {
            return redirect()->back()->with('success','Category emptied successfully.');
        }
    }

    public function toggle(Classification $classification)
    {
        if ($classification->published == 1) {
            $classification->published = 0;
            $feedback = 'Category Unpublished successfully';
        } else {
            $classification->published = 1;
            $feedback = 'Category Unpublished successfully';
        }
        if ( ! $classification->save()) {
            return redirect()->back()->with('error', 'Could not update Slider');
        }
        return redirect()->back()->with('success', $feedback);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classifications = Classification::all ();
        return view('contentmanagement::classifications.index', compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contentmanagement::classifications.create');
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
            'label' => 'required'
        ]);
        $this->data = $request->all();
        if(!$this->saveClassification())
        {
            return redirect()->back()->with('error','Category entry error.');
        }
        return redirect()->back()->with('success','Category Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function show(Classification $classification)
    {
        //
        return view('contentmanagement::classifications.show',compact('classification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function edit(Classification $classification)
    {
        //
        return view('contentmanagement::classifications.edit', compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classification $classification)
    {
        //
        $this->validate($request, [
        'published' => 'required',
        'label' => 'required'
        ]);
        $this->data = $request->all();
        if($this->saveClassification())
        {
            return redirect()->route('classifications.show', $this->classification->id)->with('success','Category Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classification $classification)
    {
        //
        $classification->delete();
        return redirect()->back()
                        ->with('success','Category deleted successfully');
    }
}
