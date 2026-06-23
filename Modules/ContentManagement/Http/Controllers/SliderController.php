<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use File;
use Image;

class SliderController extends Controller
{
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
        return view('contentmanagement::sliders.create');
    }

    public function manage()
    {
        $sliders = Slider::all();
        return view('contentmanagement::sliders.manage', compact('sliders'));
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
            'caption' => 'required',
            'highlight' => 'required',
            'display_media' => 'required',
            'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:2000'
        ]);

        $this->data = $request->all();
        if ($request->hasFile('display_media')) {
            $this->display_media = $request->file('display_media');
        }
        if ( !$this->saveSlide()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
       return redirect()->route('sliders.manage')->with('success','Slider Added successfully.');
    }

    public function saveSlide()
    {
        $this->slider = new Slider;
        $this->slider->caption = $this->data['caption'] ;
        $this->slider->highlight = $this->data['highlight'] ;
        $this->slider->button_one    = !empty($this->data['button_one']) ? $this->data['button_one'] : NULL;
        $this->slider->button_one_link    = !empty($this->data['button_one_link']) ? $this->data['button_one_link'] : NULL;
        $this->slider->button_two    =!empty($this->data['button_two']) ? $this->data['button_two'] : NULL;
        $this->slider->button_two_link    = !empty($this->data['button_two_link']) ? $this->data['button_two_link'] : NULL;
        $this->slider->published = !empty($this->data['published']) ? $this->data['published'] : true;
        if(isset($this->display_media))
        {
            $this->saveDisplayMedia() ;
        }
        if ( ! $this->slider->save()) {
            return redirect()->back()->withInput()->withErrors('Something went wrong with data entry');
        }
        return $this->slider;
    }

    public function toggle(Slider $slider)
    {
        if ($slider->published == true) {
            $slider->published = 0;
            $feedback = $slider->caption .' Slider Unpublished successfully';
        } else {
            $slider->published = true;
            $feedback = $slider->caption .' Slider Unpublished successfully';
        }
        if ( !$slider->save()) {
            return redirect()->back()->with('error', 'Could not update Slider');
        }
        return redirect()->back()->with('success', $feedback);
    }

    public function bulkreorder(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'sequence_no' => 'required',
            'slider_id' => 'required'
        ]);
        $data = $request->all();
        for ($idx = 0; $idx < count($data['slider_id']); $idx++)
            {
                $this->data['slider_id'] = $data['slider_id'][$idx];
                $this->data['sequence_no'] = $data['sequence_no'][$idx];
                $this->saveDisplayOrder();
            }
        return redirect()->back()->with('success','Display Orders Updated Successfully.');
        //return redirect()->back()->with('success','Class Slider Taken Successfully.');
    }

    public function saveDisplayOrder()
    {
        $this->slider = Slider::findorFail($this->data['slider_id']);
        $this->slider->sequence_no = !empty($this->data['sequence_no']) ? $this->data['sequence_no'] :$this->slider->sequence_no;

        if ( ! $this->slider->save()) {
            return redirect()->back()->withInput()->withErrors('Somrthing went wrong');
        }
        return $this->slider;
    }

    public function saveDisplayMedia()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/sliders/')) {
                $slider_image = File::makeDirectory('images/sliders', 0777, true);
            }
            $filename = Str::slug($this->slider->caption).'_'.time().'.'.$this->display_media->getClientOriginalExtension();
            $slider_image = 'images/sliders/originals/' . $filename;
            $this->slider->display_media     = $slider_image;
            // upload image to server
            if (($slider_image) == true) {
                Image::make($this->display_media)->fit(1200, 500, function ($constraint) {
                        $constraint->upsize();
                    })->save($slider_image);
               
            }
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'slider_id' => 'required',
            'display_media' => 'required',
            'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->slider = Slider::findorFail($request->slider_id);
        if ($request->hasFile('display_media')) {
            $this->display_media = $request->file('display_media');
            $this->saveDisplayMedia() ;
            $this->slider->save();
        }
        return redirect()->back()->with('success','Display Media Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
        return view('contentmanagement::sliders.show',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        return view('contentmanagement::sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $request->validate([
            'caption' => 'required',
            'highlight' => 'required',
            // 'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);

        if ( !$slider->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('something went wrong');
        }
       return redirect()->route('sliders.show', $slider)->with('success','Slider Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
        $slider->delete();
        return redirect()->back()
                        ->with('success','Slider deleted successfully');
    }
}
