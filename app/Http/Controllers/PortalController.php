<?php

namespace App\Http\Controllers;

use Modules\ContentManagement\Entities\HowItWork;
use Modules\ContentManagement\Entities\Advantage;
use Modules\ContentManagement\Entities\Faq;
use Modules\OrganizationManagement\Entities\Outlet;
use Modules\ContentManagement\Entities\Slider;
use Modules\CatalogManagement\Entities\Expertise;
use App\Models\Portal;
use Modules\ContentManagement\Entities\Testimonial;
use Modules\LocationManagement\Entities\Country;
use Modules\LocationManagement\Entities\State;
use Modules\SocialManagement\Entities\SocialHandle;
use Modules\SocialManagement\Entities\SocialPlatform;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\Post;
use Modules\ContentManagement\Entities\Instruction;
use Modules\CatalogManagement\Entities\Feature;
use Modules\ContentManagement\Entities\ContentSection;
use Illuminate\Http\Request;
use DB;
use Session;
use Excel;
use File;

class PortalController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
        //$this->currentterm = FiscalYear::where('status', 'Current')->first();
        $this->addressPrefix = [
            'No',
            'Plot',
            'Suite',
            'Block'
        ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('portals.index');
    }

    public function welcome()
    {
        $page_tag = 'about';
        $posts = Post::where('published', true)->orderBy('date_published')->take(4)->get(); // update with rand
        $page = Page::where('page_tag', $page_tag)->first();
        $testimonials = Testimonial::active()->get();
        $slides = Slider::active()->orderBy('sequence_no', 'ASC')->get();
        $expertises = Expertise::active()->get();
        $features = Feature::featured()->get();
        $advantages = Advantage::general()->take(4)->get();
        $howitworks = HowItWork::public()->get();
        $sections = ContentSection::active()->where('page', 'home')->get()->keyBy('section_key');
        return view('welcome', compact('slides', 'page', 'posts','testimonials','expertises', 'advantages', 'howitworks', 'features', 'sections'));
    }

    public function landing()
    {
        $page_tag = 'home';
        $page = Page::where('page_tag', $page_tag)->first();
        $slides = Slider::active()->get();
        $advantages = Advantage::active()->take(4)->get();
        return view('landing', compact('page', 'slides', 'advantages'));
    }

    public function construction()
    {
        $page_tag = 'home';
        $page = Page::where('page_tag', $page_tag)->first();
        return view('construction', compact('page'));
    }

    public function admin(){
        $instruction = Instruction::byTag('login');
        return view('portals.login', compact('instruction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('portals.create');
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
            'subdomain' => 'required',
            'portal_name' => 'required',
            'page_id' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'portal_logo' => 'required',
            'portal_logo.*' => 'image|mimes:jpeg,jpg,png,gif|max:200'
        ]);
        $portal = new Portal;
        if ($request->hasFile('portal_logo')) {
            $portal_logo = $request->file('portal_logo');
            $org_img = $thm_img = true;
                if( ! File::exists('images/portal/originals/')) {
                    $org_img = File::makeDirectory(public_path('images/portal/originals/'), 0777, true);
                }
                    if ( ! File::exists('images/portal/thumbnails/')) {
                        $thm_img = File::makeDirectory(public_path('images/portal/thumbnails'), 0777, true);
                    }
            //foreach($images as $key => $image) {
                $filename = Str::slug($request->portal_name).'_'.time().'.'.$portal_logo->getClientOriginalExtension();
                $org_path = 'images/portal/originals/' . $filename;
                $thm_path = 'images/portal/thumbnails/' . $filename;
                $portal->Organization->official_logo = 'images/portal/originals/'.$filename;
                $portal->Organization->official_logo = 'images/portal/thumbnails/'.$filename;
                    if (($org_img && $thm_img) == true) {
                        Image::make($portal_logo)->fit(1200, 500, function ($constraint) {
                                $constraint->upsize();
                            })->save($org_path);
                        Image::make($portal_name)->fit(300, 245, function ($constraint) {
                            $constraint->upsize();
                        })->save($thm_path);
                    }
            }

       // }
        $portal->Organization->organization_name     = $request->portal_name;
        $portal->subdomain     = $request->subdomain;
        $portal->email    = $request->email;
        $portal->custom_url    = $request->custom_url;
        $portal->telephone    = $request->telephone;
        $portal->Organization->slogan    = $request->slogan;
        $portal->telephone    = $request->telephone;
        $portal->date_started    = $request->date_started;
        //$portal->email    = $request->email;
        $page= Page::findorFail($request->page_id);
        if ( ! $page->Portal->save($portal)) {
            //code to delete create images
            Session::flash('error', 'Error inserting the data..');
            return redirect()->back()->withInput()->withErrors($validator);
        }
       Session::flash('success', 'Activity Added successfully.');
       return redirect()->route('manageActivities')->with('success','Activity Added successfully.');
    }
    public function changestatus(Request $request, Activity $portal)
    {
        $portal = Activity::findOrFail($request->id);
        if ($portal->published == 1) {
            $portal->published = 0;
            $published = 'Not Published';
        } else {
            $portal->published = 1;
            $published = 'Published';
        }
        if ( ! $portal->save()) {
            Session::flash('error', 'Record status could not be changed.');
            return redirect()->route('manageActivities');
        }
        Session::flash('success', 'Status has been updated successfully '.$published);
        return redirect()->route('manageActivities');
    }

    public function manage()
    {
        //
        $portals = Portal::all ();
        return view ('portals.manage', compact('portals'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function show(Portal $portal)
     {
        $portal->load('Organization');
        $addressPrefix = $this->addressPrefix;
        $outletTypes = [
            'HeadQuarter' => 'HeadQuarter',
            'Branch' => 'Branch Office'
        ];
        $outlets = Outlet::with('City')
            ->where('organization_id', $portal->organization_id)
            ->orderBy('id', 'desc')
            ->get();
        $states = State::all()->pluck("state_name", "id");
        $countries = Country::active()->pluck("label", "code");
        $socialPlatforms = SocialPlatform::all()->pluck("platform_name", "id");;
        $socialhandles = SocialHandle::where('organization_id', $portal->organization_id)->get();
        return view('portals.show',compact('portal', 'addressPrefix', 'states', 'countries', 'outlets', 'outletTypes', 'socialhandles', 'socialPlatforms'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Portal  $portal
      * @return \Illuminate\Http\Response
      */
     public function edit(Portal $portal)
     {
         return view('portals.edit',compact('portal'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Portal  $Portal
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Portal $portal)
     {

        $request->validate([
            'email' => 'required',
            'telephone' => 'required',
            //'portal_logo.*' => 'image|mimes:jpeg,jpg,png,gif|max:200'
        ]);
        $portal = Portal::findorFail($portal->id);
            $portal->email    = $request->email;
            $portal->telephone    = $request->telephone;
            //$portal->email    = $request->email;
            if ( ! $portal->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
       Session::flash('success', 'Portal Updated successfully.');
       return redirect()->back()->with('success','Portal Updated successfully.');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Portal  $portal
      * @return \Illuminate\Http\Response
      */
     public function destroy(Portal $portal)
     {
         $portal->delete();
         return redirect()->route('portals.manage')
                         ->with('success','Portal deleted successfully');
     }
}
