<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Page;
use Modules\ClientManagement\Entities\Organization;
use Modules\FacilityManagement\Entities\Facility;
use Modules\ContentManagement\Traits\PageTrait;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;
use Image;
use Modules\CatalogManagement\Entities\Price;
use Modules\HumanResources\Entities\Employee;
use Modules\ProfileManagement\Entities\Member;

class PageController extends Controller
{
    use PageTrait;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::all ();
        return view('contentmanagement::pages.index' )->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pages = Page::all()->pluck("headline", "id");
        return view('contentmanagement::pages.create', compact('pages'));
    }

    public function page($slug)
    {
        $page = Page::where('page_tag', !empty($slug) ? $slug : 'home')->firstOrFail();
        if($page->page_tag =='about')
        {
            $employees = Employee::active()->get();
            return view('contentmanagement::pages.about', compact('page', 'employees'));
        }
        return view('contentmanagement::pages.page', compact('page'));
    }

    public function privacy()
    {
        $page_tag = 'privacy-policy';
        $page = Page::where('page_tag', $page_tag)->first();
        return view('contentmanagement::pages.page', compact('page'));
    }

    public function pricing()
    {
        $page_tag = 'pricing';
        $page = Page::where('page_tag', $page_tag)->first();
        $prices = Price::active()->get();
        return view('contentmanagement::pages.pricing', compact('page', 'prices'));
    }

    public function toggle(Page $page)
    {
        if ($page->published == true) {
            $page->published = false;
            $feedback = 'Page Unpublished successfully';
        } else {
            $page->published = true;
            $feedback = 'Page Published successfully';
        }
        if ( ! $page->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function thumbnail(Page $page)
    {
        if ($page->show_thumbnail == true) {
            $page->show_thumbnail = false;
            $feedback = 'Thumbnail Disabled Successfully';
        } else {
            $page->show_thumbnail = true;
            $feedback = 'Thumbnail Enable successfully';
        }
        if ( ! $page->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'page_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->page = Page::findorFail($request->page_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->page->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function changethumb(Request $request)
    {
        //
        $this->validate($request, [
            'page_id' => 'required',
            'thumbnail' => 'required',
            'thumbnail.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->page = Page::findorFail($request->page_id);
        if ($request->hasFile('thumbnail')) {
            $this->thumbnail = $request->file('thumbnail');
            $this->saveThumbnail() ;
            $this->page->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
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
            'headline' => 'required',
            'body' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if ( !$this->savePage()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->route('pages.show', $this->page->page_tag)->with('success','Page Added successfully.');
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        //
        $pages = Page::all ();
        return view ('contentmanagement::pages.manage', compact('pages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
     public function show(Page $page)
     {
         return view('contentmanagement::pages.show',compact('page'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Page  $page
      * @return \Illuminate\Http\Response
      */
     public function edit(Page $page)
     {
         //$academic_terms = AcademicTerm::all()->pluck("page_tag");
         $parents = Page::all();
         return view('contentmanagement::pages.edit',compact('page', 'parents'));
     }


     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Page  $Page
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Page $page)
     {
        $this->validate($request, [
            'headline' => 'required',
            'body' => 'required',
        ]);

        if ( ! $page->update($request->all())) {
            Session::flash('error', 'Error updating page..');
            return redirect()->back()->withInput()->withErrors($validator);
        }
       return redirect()->route('pages.show', $page->page_tag)->with('success','Page Updated successfully.');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Page  $page
      * @return \Illuminate\Http\Response
      */
     public function destroy(Page $page)
     {
         $page->delete();
         return redirect()->back()
                         ->with('success','Page deleted successfully');
     }
}
