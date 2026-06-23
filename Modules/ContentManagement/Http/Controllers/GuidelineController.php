<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Guideline;
use Modules\ContentManagement\Entities\Instruction;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Http\Request;
use Session;

class GuidelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'guideline';
        $page = Page::where('page_tag', $page_tag)->first();
        $guidelines = Guideline::active()->paginate(8);
        return view('contentmanagement::guidelines.index', compact('guidelines', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $guidelines = Guideline::all()->pluck("label", "id");
        return view('contentmanagement::guidelines.create', compact('guidelines'));
    }
    public function guideline($slug)
    {
        $page_tag = 'guideline';
        $page = Instruction::where('tag', $page_tag)->first();
        $guideline = Guideline::where('slug', $slug)->first();
        $guidelines = Guideline::all();
        return view('contentmanagement::guidelines.preview', compact('page', 'guideline', 'guidelines'));
    }

    public function toggle(Guideline $guideline)
    {
        if ($guideline->enabled == 1) {
            $guideline->enabled = 0;
            $feedback = 'Guideline Unpublished successfully';
        } else {
            $guideline->enabled = 1;
            $feedback = 'Guideline Published successfully';
        }
        if ( ! $guideline->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function SaveGuideline()
    {
        $guideline = new Guideline;
        $guideline->label = $this->data['label'];
        $guideline->organization_id = !empty($this->data['organization_id']) ? $this->data['organization_id'] : NULL;
        $guideline->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $guideline->enabled = !empty($this->data['enabled']) ? $this->data['enabled'] : '1';

        if ( ! $guideline->save()) {
            return redirect()->back()->withInput()->withErrors('error', 'Data entry Error');
        }
        return $guideline;
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
            'label' => 'required',
            // 'organization_id' => 'required',
            'overview' => 'required',
        ]);

        $this->data = $request->all();
        $guideline = $this->SaveGuideline();
        if(!$guideline)
        {
            return redirect()->back()->with('error','policy creation error.');
        }
        return redirect()->route('guidelines.show', $guideline->id)->with('success','Policy created added successfully.');
    }

    public function manage()
    {
        //
        $guidelines = Guideline::all();
        return view('contentmanagement::guidelines.manage', compact('guidelines'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guideline  $guideline
     * @return \Illuminate\Http\Response
     */
    public function show(Guideline $guideline)
    {
        //
        return view('contentmanagement::guidelines.show',compact('guideline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guideline  $guideline
     * @return \Illuminate\Http\Response
     */
    public function edit(Guideline $guideline)
    {
        //
         return view('contentmanagement::guidelines.edit',compact('guideline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guideline  $guideline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guideline $guideline)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required'
        ]);
        if($guideline->update($request->all()))
        {
            return redirect()->back()->with('success','Policy Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guideline  $guideline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guideline $guideline)
    {
        //
        $guideline->delete();
         return redirect()->back()->with('success','Policy deleted successfully');
    }
}
