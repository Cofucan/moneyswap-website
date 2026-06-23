<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Video;
use Modules\ContentManagement\Entities\Album;
use Modules\ProjectManagement\Entities\Cause;
use Modules\CatalogManagement\Entities\Expertise;
use App\Models\Event;
use DB;
use Session;
use Excel;
use File;
use Image;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::all ();
        return view('contentmanagement::videos.index', compact('videos'));
    }

    public function manage()
    {
        //
        $videos = Video::paginate(10);
        return view('contentmanagement::videos.manage', compact('videos'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contentmanagement::videos.create');
    }

    public function toggle(Video $video)
    {
        if ($video->published == 1) {
            $video->published = 0;
            $feedback = $video->label .' video is no longer visible to the public';
        } else {
            $video->published = 1;
            $feedback = $video->label . ' video Published successfully';
        }
        if ( ! $video->save()) {
            return redirect()->back()->with('error', 'something went wrong, please try again later');
        }
        return redirect()->back()->with('success', $feedback);
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
            'link' => 'required',
        ]);
        $video = new Video;
        $owner_type = $request->owner_type;
        $video->label = $request->label ;
        $video->link = $request->link;
            switch ($owner_type){
            
            case "album":
                $album = Album::find($request->owner_id);
                $album->Videos()->save($video);
                break;
            case "cause":
                $cause = Cause::find($request->owner_id);
                $cause->Videos()->save($video);
                break;
            case "expertise":
                $expertise = Expertise::find($request->owner_id);
                $expertise->Videos()->save($video);
                break;
            default:
            $video->save();
            }

            if(!isset($video->id))
            {
                Session::flash('error', 'Error inserting the data..');
                return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again');
            }         
            //end addition
            return redirect()->back()->with('success','Video Added successfully.');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,jpg,png,gif|max:8000'
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $org_img = $thm_img = true;
            if( ! File::exists('images/video/originals/')) {
                $org_img = File::makeDirectory(public_path('images/video/originals/'), 0777, true);
            }
            if ( ! File::exists('images/video/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/video/thumbnails'), 0777, true);
            }
            foreach($images as $key => $image) {
                $video = new Video;
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                $org_path = 'images/video/originals/' . $filename;
                $thm_path = 'images/video/thumbnails/' . $filename;
                $video->image     = $org_path;
                $video->thumbnail = $thm_path;
                $video->title     = $request->title;
                $video->status    = $request->status;
                if ( ! $video->save()) {
                    flash('Video could not be updated.')->error()->important();
                    return redirect()->back()->withInput();
                }
               if (($org_img && $thm_img) == true) {
                   Image::make($image)->fit(900, 500, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                   Image::make($image)->fit(270, 160, function ($constraint) {
                       $constraint->upsize();
                   })->save($thm_path);
               }
            }
        }
        Session::flash('success', 'Image uploaded successfully.');
        return redirect()->action('VideoController@manage');
    }

 
    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
        $videos = Video::active()->get();
        return view('contentmanagement::videos.show',compact('video','videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
        $videos = Video::all();
        return view('contentmanagement::videos.edit', compact('videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            // 'job_description' => 'required'
        ]);
        if ( ! $video->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }
       return redirect()->back()->with('success','Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        
        $video->delete();
        return redirect()->back()->with('success','Video deleted successfully.');
    }
}
