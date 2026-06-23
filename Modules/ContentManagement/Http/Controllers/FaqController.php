<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\Faq;
use Modules\ContentManagement\Entities\FaqCategory;
use Illuminate\Http\Request;
use Session;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page_tag = 'faq';
        $page = Page::where('page_tag', $page_tag)->first();
        $faqSections = $this->buildFaqSections();
        $faqs = $faqSections->flatMap(function ($section) {
            return $section->faqs;
        })->values();
        return view('contentmanagement::faqs.index', compact('faqs', 'page', 'faqSections'));

    }
    public function home()
    {
        //
        $page_tag = 'faq';
        $page = Page::where('page_tag', $page_tag)->first();
        $faqSections = $this->buildFaqSections();
        $faqs = $faqSections->flatMap(function ($section) {
            return $section->faqs;
        })->values();
        return view('contentmanagement::faqs.home', compact('faqs', 'page', 'faqSections'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $faqcategories = $this->getFaqCategories();
        return view('contentmanagement::faqs.create', compact('faqcategories'));
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
        $request->validate([
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);
        $faq = new Faq;

        $faq->question     = $request->question;
        $faq->faq_category_id     = $request->faq_category_id;
        $faq->answer    = $request->answer;
        $faq->published = $request->has('published');
        if ( !$faq->save()) {
            return redirect()->back()->withInput()->withErrors('Something went wrong');
        }
       return redirect()->route('faqs.manage')->with('success','Faq Added successfully.');
    }

    public function manage()
    {
        //
        $faqs = Faq::available()->get();
        $faqcategories = $this->getFaqCategories();
        return view('contentmanagement::faqs.manage', compact('faqs', 'faqcategories'));
    }

    public function toggle(Faq $faq)
    {
        $faq->published = ! $faq->published;
        $faq->save();

        return redirect()->back()->with('success', 'Faq status updated successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
        return view('contentmanagement::faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
        $faqcategories = $this->getFaqCategories();
        return view('contentmanagement::faqs.edit', compact('faq', 'faqcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //
        $request->validate([
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);

        $payload = [
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'published' => $request->has('published'),
        ];

        if ( ! $faq->update($payload)) {
            return redirect()->back()->withInput()->withErrors('Something went wrong');
        }
       return redirect()->back()->with('success','Faq Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        //
        $faq->delete();
         return redirect()->back()
                         ->with('success','Faq deleted successfully');
    }

    private function getFaqCategories()
    {
        $faqcategories = FaqCategory::orderBy('label')->get();
        if ($faqcategories->isEmpty()) {
            FaqCategory::create([
                'label' => 'General',
                'overview' => 'Default FAQ category',
                'published' => true,
            ]);
            $faqcategories = FaqCategory::orderBy('label')->get();
        }

        return $faqcategories;
    }

    private function buildFaqSections()
    {
        $sections = FaqCategory::active()
            ->with(['Faqs' => function ($query) {
                $query->active()->orderBy('id');
            }])
            ->orderBy('label')
            ->get()
            ->filter(function ($category) {
                return $category->Faqs->isNotEmpty();
            })
            ->map(function ($category) {
                return (object) [
                    'id' => (int) $category->id,
                    'label' => $category->label,
                    'slug' => !empty($category->slug) ? $category->slug : \Illuminate\Support\Str::slug($category->label),
                    'overview' => $category->overview,
                    'faqs' => $category->Faqs->values(),
                ];
            })
            ->values();

        $uncategorizedFaqs = Faq::active()
            ->whereNull('faq_category_id')
            ->orderBy('id')
            ->get();

        if ($uncategorizedFaqs->isNotEmpty()) {
            $sections->push((object) [
                'id' => 0,
                'label' => 'General',
                'slug' => 'general',
                'overview' => 'General platform questions.',
                'faqs' => $uncategorizedFaqs,
            ]);
        }

        return $sections;
    }
}
