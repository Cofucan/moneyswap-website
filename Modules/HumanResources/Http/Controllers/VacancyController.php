<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\HumanResources\Entities\Vacancy;
use Modules\HumanResources\Entities\EmploymentType;
use Modules\HumanResources\Entities\Designation;
use Modules\ClientManagement\Entities\Department;
use Modules\ContentManagement\Entities\Page;
use Modules\LocationManagement\Entities\Neighbourhood;
use Modules\HumanResources\Entities\Qualification;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Illuminate\Http\Request;
use Modules\HumanResources\Traits\VacancyTrait;
use Carbon\carbon;

class VacancyController extends Controller
{
    use VacancyTrait;
    public function __construct()
    {

        $this->employmentTypes = EmploymentType::all()->pluck("label", "id");
        $this->qualifications = Qualification::where('published', true)->pluck("label", "id");

        $this->academicTerms = AcademicTerm::where('status', '<>', 'Past')->pluck("label", "id");

    }


    public function manage()
    {
        //
        $vacancies = Vacancy::with('Designation', 'EmploymentType', 'AcademicTerm')->paginate();
        return view('humanresources::vacancies.manage', compact('vacancies'));
    }

    public function preview()
    {
        //
        $vacancies = Vacancy::with('Designation', 'EmploymentType', 'AcademicTerm', 'Department')->paginate();
        return view('humanresources::vacancies.manage', compact('vacancies'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'career';
        $page = Page::where('page_tag', $page_tag)->first();       
        // $vacancies = Vacancy::with('Designation', 'EmploymentType')->whereDate('close_at', '>=', Carbon::today()->toDateString())->orderBy("close_at", 'Desc')->get();
        $vacancies = Vacancy::with('Designation', 'EmploymentType')->whereStatus('Approved')->orderBy("close_at", 'Desc')->get();
        return view('humanresources::vacancies.index', compact('page', 'vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $designations = Designation::all()->pluck("job_role", "id");
        $employmentTypes = $this->employmentTypes;
        $qualifications = $this->qualifications;
        $neighbourhoods = Neighbourhood::all()->pluck("neighbourhood_name", "id");
        $departments= Department::all()->pluck("department_name", "id");
        $paymentCycles = $this->PaymentCycles();
        $academicTerms = $this->academicTerms;
        return view('humanresources::vacancies.create', compact('qualifications', 'paymentCycles','departments', 'employmentTypes', 'neighbourhoods','academicTerms', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'campus_id' => 'required',
            'employment_type_id' => 'required',
            'designation_id' => 'required',
            'employees_needed' => 'required',
            'description' => 'required',
            'responsibilities' => 'required',
            'label_id' => 'required',
            'close_at' => 'required',
            'qualification_id' => 'required',
            'years_of_experience' => 'required',
            'application_method' => 'required',
            'salary_from' => 'required'
        ]);


        $this->data = $request->all();
        if($this->saveVacancy())
        {
           //schedule broadcast mail to alert subscribers

            return redirect()->route('vacancies.show', $this->vacancy->id)->with('success','Vacancy Added successfully.');
        }
    }

    Public function process(Request $request)
    {
        $this->validate($request, [
           'vacancy_id' => 'required',
           'status' => 'required'
        ]);
        $this->data = $request->all();
        if($this->VacancyProcessor())
        {
            if($request->status == 'Scheduled')
            {
                return redirect()->route('vacancies.show', $this->vacancy->id)->with('success','Job posted, awaiting approval.');
            }
            return redirect()->route('vacancies.show', $this->vacancy->id)->with('success','Action performed successfully.');
        }
        // return redirect()->route('vacancies.show', $this->vacancy->id)->with('success','Action performed successfully.');?
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        //
        return view('humanresources::vacancies.show',compact('vacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        //

        $employmentTypes = $this->employmentTypes;
        $qualifications = $this->qualifications;
        // $experienceYears = $this->experienceYears;
        $academicTerms = $this->academicTerms;
        $paymentCycles = $this->PaymentCycles();
        return view('humanresources::vacancies.edit', compact('vacancy','qualifications', 'employmentTypes', 'academicTerms', 'paymentCycles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
        // dd($request->all());

        $this->validate($request, [

            'vacancy_title' => 'required',
            'employees_needed' => 'required',
            'description' => 'required',
            'responsibilities' => 'required',
            'close_at' => 'required',
            'years_of_experience' => 'required',
            'salary_from' => 'required'
        ]);
        $request->merge([
            'salary_from' => (float) str_replace(',', '', $request->salary_from),
            'salary_to' => (float) str_replace(',', '', $request->salary_to)
        ]);

        if( !$vacancy->update($request->all())) {

            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->route('vacancies.show', $vacancy->id)->with('success','Vacancy Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        //
        $vacancy->delete();
         return redirect()->back()
                         ->with('success','vacancy deleted successfully');
    }
}
