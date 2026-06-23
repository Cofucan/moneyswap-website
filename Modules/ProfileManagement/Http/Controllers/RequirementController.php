<?php

namespace Modules\ProfileManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Page;
use Modules\ProfileManagement\Entities\Requirement;
use Modules\ProfileManagement\Traits\MemberTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;
use Modules\ContentManagement\Entities\Advantage;
use Modules\ContentManagement\Entities\HowItWork;
use PDF;

class RequirementController extends Controller
{
    use MemberTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_tag = 'membership';
        $page = Page::where('page_tag', $page_tag)->first();
        $requirements = Requirement::active()->get();
        $howitworks = HowItWork::membership()->get();
        $advantages = Advantage::members()->get();
        return view('profilemanagement::requirements.index', compact('page', 'requirements', 'howitworks', 'advantages'));
    }

    public function pay()
    {
        $page_tag = 'make-payment';
        $page = Page::where('page_tag', $page_tag)->first();
        return view('profilemanagement::requirements.pay', compact('page', 'requirements'));
    }


  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('profilemanagement::requirements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'overview' => 'required',
        ]);
        $this->data = $request->all();
        $this->requirement = new Requirement;
        if ( !$this->saveRequirement($this->data)) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        return redirect()->back()->with('success','Member Requirement Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        //
        return view('profilemanagement::requirements.show',compact('requirement'));
    }

    public function toggle(Requirement $requirement)
    {
        if ($requirement->published == 1) {
            $requirement->published = 0;
            $feedback = 'Member Requirement Unpublished successfully';
        } else {
            $requirement->published = 1;
            $feedback = 'Member Requirement Published successfully';
        }
        if ( ! $requirement->save()) {
            return redirect()->back()->with('error', 'Could not update Member Requirement');
        }
        return redirect()->back()->with('success', $feedback);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        //
        $programs = $this->programs;
        return view('profilemanagement::requirements.edit',compact('requirement', 'programs'));
    }

        public function manage()
        {
        $requirements = Requirement::all();
        return view('profilemanagement::requirements.manage', compact('requirements'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirement $requirement)
    {
        //
        $this->validate($request, [
            'overview' => 'required'
        ]);
        if( ! $requirement->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Requirement Updatedd successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        //
        $requirement->delete();
        return redirect()->back()
                        ->with('success','Member Requirement deleted successfully');
    }
}
