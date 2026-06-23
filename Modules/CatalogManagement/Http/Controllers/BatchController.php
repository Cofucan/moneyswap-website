<?php

namespace Modules\SchoolManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ClientManagement\Entities\Client;
use Modules\SchoolManagement\Entities\Stream;
use Modules\SchoolManagement\Entities\Batch;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\CurriculumManagement\Entities\Subject;
use Modules\CurriculumManagement\Entities\SubjectCategory;
use Modules\HumanResources\Entities\Employee;
use Modules\SchoolManagement\Entities\Level;
use Modules\SchoolManagement\Traits\ProgramTrait;
use Illuminate\Http\Request;
use Carbon\carbon;
use Modules\CurriculumManagement\Entities\BatchSubject;
use Session;

class BatchController extends Controller
{
    use ProgramTrait;

    public function toggle(Batch $batch)
    {
        if ($batch->enabled == 1) {
            $batch->enabled = 0;
            $feedback = 'Client batch Unpublished successfully';
        } else {
            $batch->enabled = 1;
            $feedback = 'Client batch enabled successfully';
        }
        if ( ! $batch->save()) {
            return redirect()->back()->with('error', 'Could not update batch');
        }
        return redirect()->back()->with('success', $feedback);
    }


    public function batchsubjectslist(Request $request)
    {
        $batch = Batch::findorFail($request->batch_id);
        $subjectcategories = SubjectCategory::where('program_id', $batch->Level->program_id)->get()->pluck("label","id");
        return response()->json($subjectcategories);
    }

    public function manage()
    {
        //
        $batches = Batch::active()->get()
        ->groupBy(function($item) {
            return $item->level->label;
        });
        return view('schoolmanagement::batches.manage', compact('batches'));
    }

    public function employee(Employee $employee)
    {
        return view('schoolmanagement::batches.employee', compact('employee'));
    }

    public function enrolments(Batch $batch)
    {

        return view('schoolmanagement::batches.enrolments',compact('batch'));
    }

    public function addsubject(Batch $batch)
    {
        //
        return view('curriculummanagement::batchsubjects.create', compact('batch'));
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $batches = Batch::active()->get()
        ->groupBy(function($item) {
            return $item->stream->label;
        });
        return view('schoolmanagement::batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $levels = Level::active()->pluck("label", "id");
        $streams = Stream::active()->pluck("label", "id");
        return view('schoolmanagement::batches.create', compact('streams', 'levels'));
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
            'grade_id' => 'required',
            'stream_id' => 'required'
            // 'mandatory_subjects' => 'required'
        ]);
        $this->data = $request->all();
        $batch=$this->saveBatch();
        if(!$batch)
        {
            return redirect()->back()->with('error','Client Batch cannot be created at the moment.');
        }
        $this->batch_id = $batch->id;
        if(isset($request->subjectcategories))
        {
            foreach($request->subjectcategories as $key => $this->subjectcategory_id) {

                $this->saveBatchSubjects();
            }
        }
        return redirect()->route('batches.show', $batch)->with('success','Client Batch Added successfully.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        //
        $clients = Client::byBatch($batch->id)->get()->pluck("name", "id");
        $subjectcategories = SubjectCategory::active($batch->level->program_id)->pluck("label", "id");
        $employees = Employee::with('Profile')->educators()->get()->pluck("name", "id");
        return view('schoolmanagement::batches.show',compact('batch', 'employees', 'subjectcategories', 'clients'));
    }

    public function subjects(Batch $batch)
    {
        //
        $batchsubjects = BatchSubject::where('batch_id', $batch->id)->get()
        ->groupBy(function($item) {
            return $item->SubjectCategory->Division->label;
        });
        return view('schoolmanagement::batches.subjects',compact('batch', 'batchsubjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        //
        return view('schoolmanagement::batches.edit',compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        //
        $this->validate($request, [
            'mandatory_subjects' => 'required',
            'elective_subjects' => 'required'
        ]);
        if( !$batch->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->route('batches.show', $batch)->with('success','Client Batch Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        //
        if($batch->enrolments->count() > 0)
        {
            return redirect()->back()->with('error','Batch already attached to clients');
        }

        $batch->delete();
         return redirect()->back()->with('success','Batch deleted successfully');
    }
}
