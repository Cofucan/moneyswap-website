<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('humanresources')->group(function() {
    Route::get('/', 'HumanResourcesController@index');
});

Route::resource('employmenttypes', 'EmploymentTypeController');
Route::resource('employeecategories','EmployeeCategoryController');

Route::get('employees/upload', 'EmployeeController@upload')->name('employees.upload');
Route::post('employees/import', 'EmployeeController@import')->name('employees.import');
Route::post('employees/relieve', 'EmployeeController@relieve')->name('employees.relieve');
Route::get('employees/export', 'EmployeeController@export')->name('employees.export');
Route::get('employees/setup', 'EmployeeController@setup')->name('employees.setup');
Route::get('employees/notuser', 'EmployeeController@notuser')->name('employees.notuser');
// Route::get('employees/relieve/{employee}', 'EmployeeController@relieve')->name('employees.relieve');
Route::get('employees/preview/{employee}', 'EmployeeController@preview')->name('employees.preview');
Route::get('employees/manage', 'EmployeeController@manage')->name('employees.manage');
Route::get('employees/past', 'EmployeeController@past')->name('employees.past');
Route::get('employees/status/{status}','EmployeeController@status')->name('employees.status');
Route::get('employees/academics', 'EmployeeController@academics')->name('employees.academics');
Route::resource('employees', 'EmployeeController');

Route::resource('qualifications', 'QualificationController');
Route::resource('enrolmentstatuses', 'EnrolmentStatusController');
Route::get('designations/toggle/{designation}', 'DesignationController@toggle')->name('designations.toggle');
Route::resource('designations', 'DesignationController');

Route::get('educations/autocomplete', 'EducationController@autocomplete')->name('educations.autocomplete');
Route::get('educations/details/{slug}', 'EducationController@education')->name('educations.details');;
Route::get('educations/toggle/{education}', 'EducationController@toggle')->name('educations.toggle');
Route::get('educations/manage/{profile}', 'EducationController@manage')->name('educations.manage');
Route::resource('educations', 'EducationController');


Route::get('employments/preview/{slug}', 'EmploymentController@preview')->name('employments.preview');
Route::get('employments/manage', 'EmploymentController@manage')->name('employments.manage');
Route::resource('employments', 'EmploymentController');

Route::post('employeedisengagements/process', 'EmployeeDisengagementController@process')->name('employeedisengagements.preview');
Route::get('employeedisengagements/manage', 'EmployeeDisengagementController@manage')->name('employeedisengagements.manage');
Route::resource('employeedisengagements', 'EmployeeDisengagementController');

Route::get('salaryscales/manage', 'SalaryScaleController@manage')->name('manageSalaryscales');
Route::resource('salaryscales', 'SalaryScaleController');

Route::get('resumes/preview/{resume}', 'ResumeController@resume')->name('resumes.preview');
Route::get('resumes/toggle/{resume}', 'ResumeController@toggle')->name('resumes.toggle');
Route::get('resumes/manage', 'ResumeController@manage')->name('resumes.manage');
Route::resource('resumes', 'ResumeController');

Route::get('vacancies/details/{slug}', 'VacancyController@vacancy')->name('vacancies.details');
Route::get('vacancies/manage', 'VacancyController@manage')->name('vacancies.manage');
Route::post('vacancies/process', 'VacancyController@process')->name('vacancies.process');
Route::post('vacancies/updateStatus', 'VacancyController@updateStatus')->name('vacancies.updateStatus');
Route::get('vacancies/vacancytype/{vacancytype}', 'VacancyController@vacancytypes')->name('vacancies.vacancytype');
Route::resource('vacancies', 'VacancyController');


Route::get('beneficiaries/manage', 'BeneficiaryController@manage')->name('beneficiaries.manage');
Route::get('beneficiaries/{Beneficiary}/details', 'BeneficiaryController@Beneficiary')->name('beneficiaries.details');
Route::get('beneficiary/preview/{Beneficiary}', 'BeneficiaryController@preview')->name('beneficiary.preview');
Route::get('beneficiaries/toggle/{Beneficiary}', 'BeneficiaryController@toggle')->name('beneficiaries.toggle');
Route::resource('beneficiaries', 'BeneficiaryController');
