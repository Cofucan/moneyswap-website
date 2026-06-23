<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\HumanResources\Entities\Education;
use Modules\ProfileManagement\Entities\Profile;
use Modules\HumanResources\Entities\Qualification;
use Modules\ClientManagement\Entities\Organization;
use Modules\HumanResources\Traits\ResumeTrait;
use Modules\ClientManagement\Traits\DepartmentTrait;
use App\Http\Requests\EducationFormRequest;
use Session;
use Carbon\carbon;
use Auth;
class EducationController extends Controller
{
    use DepartmentTrait;
    use ResumeTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->visibilities = [
            'Private' => 'Only Me',
            'Public' => 'Every One',
            'Recruiter' => 'Recruiters Only',
        ];
    }

    public function index()
    {
        //
        $educations = Education::all();
        return view('humanresources::educations.index', compact('educations'));
    }

    public function manage()
    {
        $educations = Education::scheduled()->get();
        return view('humanresources::educations.manage', compact('educations'));
    }

    public function toggle(Education $education)
    {
        if ($education->published == 1) {
            $education->published = 0;
            $feedback = 'Academic record Unpublished successfully';
        } else {
            $education->published = 1;
            $feedback = 'Academic record published successfully';
        }
        if ( ! $education->save()) {
            return redirect()->back()->with('error', 'Could not update education');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $eduhistories = $this->getprofileEducation(Auth::user()->profile_id);
        $visibilities = $this->visibilities;
        $qualifications = Qualification::active()->pluck("label", "id");
        return view('humanresources::educations.create', compact('visibilities', 'eduhistories', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationFormRequest $request)
    {
        /* dd($request->validated());

        $this->data = $request->validated();
        FormData::create($validatedData);
        return redirect()->back()->with('success', 'The Form Data is successfully inserted to the Database!'); */

        $this->data = $request->all();
        //$this->organization = $this->makeOrganization();
        if ( ! $this->saveEducation()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $this->education->addMediaFromRequest('image')->toMediaCollection('images');
        }
        if($request->todo =='Continue')
        {
            //$resume = $this->getResumeId();
            return redirect()->route('home')->with('success','Education Record Added Successfully.');
        }else{
            return redirect()->back()->with('success', 'Education profile Added successfully.');
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
        return view('humanresources::educations.show',compact('education'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        //
        return view('humanresources::educations.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(EducationFormRequest $request, Education $education)
    {
        if( ! $education->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->back()->with('success','Education details Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        //
        $education->delete();
        return redirect()->back()
                        ->with('success','Education details deleted successfully');
    }
}
