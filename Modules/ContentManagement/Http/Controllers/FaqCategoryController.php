<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use  Modules\ContentManagement\Entities\FaqCategory;
use Illuminate\Http\Request;
use Session;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faqcategories = FaqCategory::active();
        return view('contentmanagement::faqcategories.index', compact('faqcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            
        ]);

        $this->data = $request->all();

        if ( !$this->saveFaqCategory()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }

       return redirect()->back()->with('success','Faq Category Added successfully.');
    }

    public function saveFaqCategory()
    {
        $this->faqcategory = new FaqCategory;
        $this->faqcategory->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $this->faqcategory->label = $this->data['label'];
        $this->faqcategory->published = !empty($this->data['published']) ? $this->data['published'] : false;
        if ( !$this->faqcategory->save()) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
        return $this->faqcategory;
    }

    public function toggle(FaqCategory $faqcategory)
    {
        if ($faqcategory->published == 1) {
            $faqcategory->published = 0;
            $feedback = 'Faq Category Unpublished successfully';
        } else {
            $faqcategory->published = 1;
            $feedback = 'Faq Category Unpublished successfully';
        }
        if ( ! $faqcategory->save()) {
            return redirect()->back()->with('error', 'Could not update Faq Category');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqcategory
     * @return \Illuminate\Http\Response
     */
    public function show(FaqCategory $faqcategory)
    {
        //
        return view('contentmanagement::faqcategories.show', compact('faqcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqCategory $faqcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FaqCategory  $faqcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaqCategory $faqcategory)
    {
        //
        $request->validate([
            'label' => 'required',
        ]);

        if ( ! $faqcategory->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try later');
        }
       return redirect()->back()->with('success','Faq Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaqCategory  $faqcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaqCategory $faqcategory)
    {
        //
        $faqcategory->delete();
        return redirect()->back()->with('success','Faq Category deleted successfully');
    }
}
