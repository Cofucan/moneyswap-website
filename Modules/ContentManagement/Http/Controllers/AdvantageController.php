<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\ContentManagement\Entities\Advantage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Session;
use Image;
use File;

class AdvantageController extends Controller
{

    public function SaveAdvantage()
    {
        $this->advantage = new Advantage;
        $this->advantage->label = $this->data['label'];
        // $this->advantage->display_image = $this->data['display_image'];
        $this->advantage->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->advantage->for_whom = !empty($this->data['for_whom']) ? $this->data['for_whom'] : NULL;
        $this->advantage->published = !empty($this->data['published']) ? $this->data['published'] : true;
        if(isset($this->display_image))
        {
            $this->saveDisplayImage() ;
        }
        if ( ! $this->advantage->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->advantage;
    }

    public function changeimage(Request $request)
    {
        //
        $this->validate($request, [
            'advantage_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->advantage = Advantage::findorFail($request->advantage_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->advantage->save();
        }
        return redirect()->back()->with('success','Display image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function saveDisplayImage()
    {
        // create new directory for uploading image if doesn't exist
        if ( ! File::exists('images/advantages/')) {
            $advantage_img = File::makeDirectory('images/advantages', 0777, true);
        }
        $filename = Str::slug($this->advantage->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
        $display_image_url = 'images/advantages/' . $filename;
        $this->advantage->display_image     = $display_image_url;
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
        // $advantage = Advantage::with('School')->whereSchoolId(session::get('school_id'))->first();
        $advantages = Advantage::where('published', true)->get();
        return view('contentmanagement::advantages.index', compact('advantages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $services = [
            'Members' => 'Members',
            'General' => 'General',
        ];
        return view('contentmanagement::advantages.create', compact('services'));
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
            // 'school_id' => 'required',
            'label' => 'required',
            'overview' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
        }
        if(!$this->SaveAdvantage())
        {
            return redirect()->back()->with('error','Could not save Advantage. Try Again later.');
        }
        return redirect()->route('advantages.manage')->with('success','Advantage Added successfully.');
    }

    public function toggle(Advantage $advantage)
    {
        if ($advantage->published == 1) {
            $advantage->published = 0;
            $feedback = 'Advantage Unpublished successfully';
        } else {
            $advantage->published = 1;
            $feedback = 'Advantage Published successfully';
        }
        if ( ! $advantage->save()) {
            return redirect()->back()->with('error', 'Could not update Page');
        }
        return redirect()->back()->with('success', $feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function show(Advantage $advantage)
    {
        //
        $services = [
            'Members' => 'Members',
            'General' => 'General',
        ];
        return view('contentmanagement::advantages.show',compact('advantage', 'services'));
    }

    public function manage()
    {
        $services = [
            'Members' => 'Members',
            'General' => 'General',
        ];
    $advantages = Advantage::orderBy('sequence', 'ASC')->get();
    return view('contentmanagement::advantages.manage', compact('advantages', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function edit(Advantage $advantage)
    {
        //
        $services = [
            'Members' => 'Members',
            'General' => 'General',
        ];
        return view('contentmanagement::advantages.edit',compact('advantage', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advantage $advantage)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            'overview' => 'required',
            'for_whom' => 'required',
            'display_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1000',
            'sequence' => 'nullable|integer'
        ]);
        $payload = [
            'label' => $request->label,
            'overview' => $request->overview,
            'for_whom' => $request->for_whom,
            'sequence' => $request->sequence,
            'published' => $request->has('published'),
        ];
        if( ! $advantage->update($payload)) {
            return redirect()->back()->withInput()->withErrors('error', 'Error updating record, please try again later');
        }
        if ($request->hasFile('display_image')) {
            $this->advantage = $advantage;
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage();
            $advantage->save();
        }
        return redirect()->route('advantages.manage')->with('success','Advantage Updateded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advantage  $advantage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advantage $advantage)
    {
        //
        $advantage->delete();
        return redirect()->back()
                        ->with('success','Advantage deleted successfully');
    }
}
