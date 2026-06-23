<?php

namespace Modules\CatalogManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\CatalogManagement\Entities\Program;
use Modules\CatalogManagement\Entities\Level;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\ClientManagement\Entities\Client;
//use Modules\EnrolmentManagement\Entities\Enrolment;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;


class LevelController extends Controller
{

    

    public function getstreamlist(Request $request)
     {
        $level = Level::findOrFail($request->level);
        $streams = Stream::active()->where('program_id', $level->program_id)->pluck("label","id");
         return response()->json($streams);
     }

    public function getstudents(Request $request)
    {
        $level = $request->level;
        $clients = Client::with('Profile')->where('grade_id', $level)->get()->pluck("name","id");
        return response()->json($clients);
    }

    public function getenrolments(Request $request)
    {
        $level = $request->level;
        $enrolments = Enrolment::with('Client', 'Client.Profile')->where('grade_id', $level)->get()->pluck("person.name","id");
        return response()->json($enrolments);
    }

    public function getsubjectlist(Request $request)
    {
        $level = $request->level;
        $subjects = Subject::with('SubjectCategory')->where('grade_id', $level)->pluck("code","id");
        return response()->json($subjects);
    }

    public function getgradesubjectsbyterm(Request $request)
    {
        $level = $request->level;
        $term = $request->term;
        $subjects = Subject::with('SubjectCategory')->where('grade_id', $level)->where('term_id',$term)->pluck("code","id");
        return response()->json($subjects);
    }

    public function getclassroomsubjects(Request $request)
    {
        $level = $request->level;
        $room = Room::findorFail($request->room);
        $subjects = Subject::where('grade_id', $room->grade_id)->pluck("code","id");
        return response()->json($subjects);
    }

    public function getclassroomlist(Request $request)
    {
        $level = $request->level;
        $rooms = Room::where('grade_id', $level)->pluck("label","id");
        return response()->json($rooms);
    }

    public function getbatchlist(Request $request)
    {
        $level = $request->level;
        $batches = Batch::where('grade_id', $level)->active()->pluck("label","id");
        return response()->json($batches);
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
        $programs = Program::active()->pluck("label", "id");
        $levels = Level::all()->pluck("label", "id");
        return view('catalogmanagement::levels.create', compact('programs', 'levels'));
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
        $validated = $request->all();
        if (Level::create($validated))
        {
            return redirect()->route('levels.manage')->with('success','Level Added successfully.');
        }
        return redirect()->back()->withInput()->withErrors('Error creating the new class, check the entry and try again');

    }

    public function manage()
    {
        //
        $levels = Level::with('program')->get();
        $programs = Program::has('levels')->get();
        $academicTerms = AcademicTerm::active()->pluck("label", "id");
        return view ('catalogmanagement::levels.manage', compact('levels', 'programs', 'academicTerms') );
    }
    public function toggle(Level $level)
    {
        if ($level->published == false) {
            $level->published = true;
            $feedback = $level->label .' level level enabled successfully';
        } else {
            $level->published = false;
            $feedback = $level->label .' level level disabled successfully';
        }
        if ( ! $level->save()) {
            return redirect()->back()->with('error', 'Could not update level level visibility');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
        // $enrolments = Enrolment::active()->where('grade_id', $level->id)->paginate();
        return view('catalogmanagement::levels.show',compact('level'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        //
        $programs = Program::all()->pluck("label", "id");
        $levels = Level::all()->pluck("label", "id");
        return view('catalogmanagement::levels.edit',compact('levels', 'programs', 'level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        //
        $level->update($request->all());
        return redirect()->back()
                         ->with('success','Level level updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        //
        if($level->clients->count() > 0 || $level->admissions->count() > 0)
        {
            dd('level level already in use by other services');
        }
        $level->delete();
        return redirect()->back()
                         ->with('success','level level deleted successfully');
    }
}
