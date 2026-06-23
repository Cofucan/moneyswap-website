<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\CatalogManagement\Entities\Expertise;
use Modules\ContentManagement\Entities\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Session;
use Image;
use File;

class TestimonialController extends Controller
{

    public function SaveTestimonial()
    {
        $this->testimonial = new Testimonial;
        $this->testimonial->testimony = $this->data['testimony'];
        $this->testimonial->reviewer_name = $this->data['reviewer_name'];
        $this->testimonial->label = !empty($this->data['label']) ? $this->data['label'] : '';
        $this->testimonial->reviewer_identity = !empty($this->data['reviewer_identity']) ? $this->data['reviewer_identity'] : '';
        $this->testimonial->expertise_id = !empty($this->data['expertise_id']) ? $this->data['expertise_id'] : NULL;
        $this->testimonial->published = !empty($this->data['published']) ? $this->data['published'] : true;
        if(isset($this->display_image))
        {
            $this->saveDisplayImage() ;
        }
        if ( ! $this->testimonial->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->testimonial;
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'testimonial_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->testimonial = Testimonial::findorFail($request->testimonial_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->testimonial->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function saveDisplayImage()
    {
        // create new directory for uploading image if doesn't exist
        if ( ! File::exists('images/testimonials/')) {
            $advantage_img = File::makeDirectory('images/testimonials', 0777, true);
        }
        $filename = Str::slug($this->testimonial->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
        $display_image_url = 'images/testimonials/' . $filename;
        $this->testimonial->display_image     = $display_image_url;
        // upload image to server
        Image::make($this->display_image)->fit('100', '100', function ($constraint) {
            $constraint->upsize();
        })->save($display_image_url);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $testimonial = Testimonial::with('School')->whereSchoolId(session::get('school_id'))->first();
        $testimonials = Testimonial::where('published', true)->get();
        return view('contentmanagement::testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $expertises = Expertise::active()->get();
        return view('contentmanagement::testimonials.create', compact('expertises'));
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
            //'school_id' => 'required',
            'label' => 'required',
            'testimony' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if(!$this->SaveTestimonial())
        {
            return redirect()->back()->with('error','Could not save Testimonial. Try Again later.');
        }
        return redirect()->route('testimonials.manage')->with('success','Testimonial Added successfully.');
    }

    public function toggle(Testimonial $testimonial)
    {
        if ($testimonial->published == 1) {
            $testimonial->published = 0;
            $feedback = 'Testimonial Unpublished successfully';
        } else {
            $testimonial->published = 1;
            $feedback = 'Testimonial Published successfully';
        }
        if ( ! $testimonial->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
        $services = [
            'Members' => 'Members',
            'General' => 'General',
        ];
        return view('contentmanagement::testimonials.show',compact('testimonial', 'services'));
    }

    public function manage()
    {
        $expertises = Expertise::active()->get();
        $testimonials = Testimonial::all();
        return view('contentmanagement::testimonials.manage', compact('testimonials', 'expertises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
        $services = [
            'Members' => 'Members',
            'General' => 'General',
        ];
        return view('contentmanagement::testimonials.edit',compact('testimonial', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'testimony' => 'required'
        ]);
        if( ! $testimonial->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        return redirect()->route('testimonials.manage')->with('success','Testimonial Updateded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
        $testimonial->delete();
        return redirect()->back()
                        ->with('success','Testimonial deleted successfully');
    }
}
