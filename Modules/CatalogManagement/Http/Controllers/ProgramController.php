<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CatalogManagement\Entities\Program;
use Modules\CatalogManagement\Entities\Cause;
use Modules\CatalogManagement\Traits\ProgramTrait;
use Modules\ScholarshipManagement\Entities\Requirement;
use Modules\ContentManagement\Entities\Page;
use Modules\CatalogManagement\Entities\Level;
use File;
use DB;
use Session;
use Excel;

use Image;

class ProgramController extends Controller
{
    use ProgramTrait;

    public function getrequirementlist(Request $request)
    {
        $program = $request->program;
        $admission_requirements = AdmissionRequirement::where('program_id', $program)->pluck("requirement","id");
        return response()->json($admission_requirements);
    }

    public function getbatchlist(Request $request)
    {
        $this->programId = $request->program;
        $batches = Batch::active()->whereHas('Level', function($item){
            $item->where('program_id', $this->programId);
        })->pluck("label", "id");
        return response()->json($batches);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_tag = 'program';
        $page = Page::where('page_tag', $page_tag)->first();
        $programs = Program::with('Subject')->paginate(12);
        return view('catalogmanagement::programs.index', compact('programs', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $causes = Cause::active()->get();
        $programs = Program::active()->get();
        return view('catalogmanagement::programs.create', compact('programs','causes'));
    }
    public function details($slug)
    {
        $program = $this->getCourseDetails($slug);
        $featuredcourses = Program::whereFeatured(true)->take(4)->get();
        return view('catalogmanagement::programs.details', compact('program', 'featuredcourses'));
    }


    public function subjectcategory(Program $program)
    {
        //
        return view('catalogmanagement::programs.details',compact('program'));
    }
    public function toggle(Program $program)
    {
        if ($program->enabled == 1) {
            $program->enabled = 0;
            $feedback = $program->label . ' Program Unpublished successfully';
        } else {
            $program->enabled = 1;
            $feedback = $program->label . ' Program enabled successfully';
        }
       /*  $program->Levels()->each(function($level){
            $level->enabled = $program->enabled;
            $level->save();
        }); */
        $program->levels->enabled = $program->enabled;
        if ( ! $program->push()) {
            return redirect()->back()->with('error', 'Operation could not be performed, try again later');
        }
        return redirect()->back()->with('success', $feedback);
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
            'overview' => 'required',
            'tenure_months' => 'required'
        ]);
        $this->data = $request->all();
        $program = $this->saveProgram();
        if(!$program )
        {
            return redirect()->back()->withInput()->withErrors('error', 'Operation could not be performed, try again later');
        }
       return redirect()->route('programs.show', $program->id)->with('success','Program Created successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        //
        $programs = Program::all();
        return view('catalogmanagement::programs.manage', compact('programs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
     public function show(Program $program)
     {
         //$feeschedules = FeeSchedule::where('program_id', $program->id)->get();
        $levels = Level::all()->pluck("label", "id");
        return view('catalogmanagement::programs.show',compact('program', 'levels'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Program  $program
      * @return \Illuminate\Http\Response
      */
     public function edit(Program $program)
     {
         return view('catalogmanagement::programs.edit',compact('program'));
     }


     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Program  $Program
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Program $program)
     {
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:8000'
        ]);

        if(!$program->update($request->all()))
        {
            return redirect()->back()->withInput()->withErrors('error', 'Operation could not be performed, try again later');
        }
       return redirect()->route('programs.show', $program->id)->with('success','Program Updated successfully.');
     }

     public function getgradelist(Request $request)
     {
        $program = $request->program;
        $levels = Level::where('program_id', $program)->pluck("label","id");
        return response()->json($levels);
     }

     public function getstreams(Request $request)
     {
         $program = $request->program;
        $streams = Stream::where('program_id', $program)->pluck("label","id");
         return response()->json($streams);
     }



     public function getregistrationfee(Request $request)
     {
         //$program = $request->program;
         $program = Program::findOrFail($program);
         $regfee = $program->RegistrationFee->pluck("rate","id");
        //$regfee = number_format($fee,2);
        return response()->json($regfee);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Program  $program
      * @return \Illuminate\Http\Response
      */
     public function destroy(Program $program)
     {
         $program->delete();
         return redirect()->back()
                         ->with('success','Program deleted successfully');
     }
}
