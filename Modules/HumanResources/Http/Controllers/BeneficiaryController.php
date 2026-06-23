<?php

namespace Modules\HumanResources\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\AccountManagement\Entities\Currency;
use Modules\AccountManagement\Entities\TransactionFrequency;
use Modules\ContentManagement\Entities\Page;
use Modules\HumanResources\Entities\Beneficiary;
use Modules\AppealManagement\Entities\Campaign;
use Modules\LocationManagement\Entities\Country;
use Modules\HumanResources\Traits\BeneficiaryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Excel;
use File;
use Image;

class BeneficiaryController extends Controller
{
    use BeneficiaryTrait;
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }


    public function beneficiary($slug)
    {
        $beneficiary = Beneficiary::where('slug', $slug)->first();
        $beneficiaries = Beneficiary::active()->get();
        return view ('humanresources::beneficiaries.beneficiary', compact('beneficiary', 'beneficiaries'));
    }


    public function preview(Beneficiary $beneficiary)
    {

        return view('humanresources::beneficiaries.preview', compact('beneficiary'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $beneficiaries = Beneficiary::active()->paginate(6);
        $causes = Cause::has('beneficiaries')->take(3)->get();
        return view ('humanresources::beneficiaries.index', compact('beneficiaries', 'causes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_tag = 'get-help';
        $page = Page::where('page_tag', $page_tag)->first();
        $countries = Country::active()->pluck("label", "code");
        $telcodes = Country::active()->pluck("dialling_code", "code");
        $campaigns = Campaign::active()->pluck("label", "id");
        $currencies = Currency::active()->pluck("code", "id");
        return view('humanresources::beneficiaries.create', compact('causes', 'page','countries','telcodes','currencies'));
    }


    public function manage()
    {
        //
        $beneficiaries = Beneficiary::all ();
        return view('humanresources::beneficiaries.manage', compact('beneficiaries'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'cause_id' => 'required',
            'telephone' => 'required',
            'remarks' => 'required',
        ]);
        $this->data = $request->all();
        $beneficiary = $this->saveBeneficiary();
        if ( !$beneficiary) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->route('beneficiaries.show', $beneficiary)->with('success','request submitted successfully.');
    }

    public function toggle(Beneficiary $beneficiary)
    {
        if ($beneficiary->enabled == true) {
            $beneficiary->enabled = false;
            $feedback = $beneficiary->label . 'Beneficiary Deactivated successfully';
        } else {
            $beneficiary->enabled = true;
            $feedback = $beneficiary->label . 'Beneficiary has been Activated';
        }
        if ( ! $beneficiary->save()) {
            return redirect()->back()->with('error', 'Could not update beneficiary status');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function fund(Beneficiary $beneficiary = null)
    {
        // if(is_null($beneficiary))
        // {
        //     return view('humanresources::beneficiaries.fund');
        // }
        // $beneficiaries = Beneficiary::active()->get();

        $currencies = Currency::active()->pluck("code", "id");
        $beneficiaries = Beneficiary::active()->pluck("label", "id");
        $telcodes = Country::active()->pluck("dialling_code", "id");
        $transactionfrequencies = TransactionFrequency::active()->pluck("public_name", "id");
        return view('humanresources::beneficiaries.fund', compact('beneficiary', 'beneficiaries', 'currencies', 'telcodes', 'transactionfrequencies'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiary $beneficiary)
    {
        //$beneficiary->loadCount('transactions');
        // Or even with extra condition
       /*  $product->loadCount(['reviews' => function ($query) {
            $query->where('rating', 5);
        }]); */
        return view('humanresources::beneficiaries.preview', compact('beneficiary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiary $beneficiary)
    {
        $causes= Cause::active()->get();
         return view('humanresources::beneficiaries.edit',compact('beneficiary', 'causes'));
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'beneficiary_id' => 'required',
            'display_media' => 'required',
            'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $beneficiary = Beneficiary::findorFail($request->beneficiary_id);
        if ($request->hasFile('display_media')) {
            $this->display_media = $request->file('display_media');
            $this->saveDisplayMedia($beneficiary) ;
            $beneficiary->save();
        }
        return redirect()->back()->with('success','Display Media Updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiary $beneficiary)
    {
        $request->validate([
            'label' => 'required',
            'overview' => 'required',
            'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        if ( !$beneficiary->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error Updating beneficiary beneficiary.');
        }
       return redirect()->route('beneficiaries.show', $beneficiary->slug)->with('success','Beneficiary Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiary $beneficiary)
    {
        if($beneficiary->donors->count() > 0)
        {
            return redirect()->back()->with('warning', 'Beneficiary Cannot be Deleted');
        }
        $beneficiary->delete();
          return redirect()->back()->with('success', 'Beneficiary Deleted Successfully');
    }
}
