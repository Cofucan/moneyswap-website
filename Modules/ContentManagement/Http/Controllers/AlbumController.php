<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Album;
use Modules\ContentManagement\Entities\Media;
use Modules\ContentManagement\Entities\Page;
use App\Models\Event;
use DB;
use Session;
use Excel;
use File;
use Image;

use Illuminate\Http\Request;
use Modules\ContentManagement\Entities\Video;

class AlbumController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $albums = Album::active()->get();
        // $videos = Video::active()->get();
        return view('contentmanagement::albums.index', compact('albums'));
    }

    public function manage()
    {
        //
        $albums = Album::paginate(10);
        return view('contentmanagement::albums.manage', compact('albums'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contentmanagement::albums.create');
    }

    public function toggle(Album $album)
    {
        if ($album->published == 1) {
            $album->published = 0;
            $feedback = $album->label .' album is no longer visible to the public';
        } else {
            $album->published = 1;
            $feedback = $album->label . ' album Published successfully';
        }
        if ( ! $album->save()) {
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
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:8000'
        ]);
        $album = new Album;
        $galleryable_type = $request->galleryable_type;
        $album->label = $request->label ;
        $album->overview = $request->overview;
            switch ($galleryable_type){           
            case "page":
                $page = Page::find($request->galleryable_id);
                $page->Galleries()->save($album);
                break;
            case "event":
                $event = Event::find($request->galleryable_id);
                $event->Galleries()->save($album);
                break;
           
            default:
            $album->save();
            }

            if(!isset($album->id))
            {
                Session::flash('error', 'Error inserting the data..');
                return redirect()->back()->withInput()->withErrors('error', 'Something went wrong, try again');
            }

            //
             //check if image exist 
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading gallery image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                //create new instance of Photo class
                $newPhoto = new Photo;
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
                $newPhoto->image     = $org_path;
                $newPhoto->thumbnail = $thm_path;
                $newPhoto->gallery_id = $album->id;
                //don't upload file when unable to save name to database
                if ( ! $newPhoto->save()) {
                    return false;
                }
                // upload image to server
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
            //end addition
            return redirect()->route('albums.show', $album->slug)->with('success','Album Created successfully.');
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
            if( ! File::exists('images/album/originals/')) {
                $org_img = File::makeDirectory(public_path('images/album/originals/'), 0777, true);
            }
            if ( ! File::exists('images/album/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/album/thumbnails'), 0777, true);
            }
            foreach($images as $key => $image) {
                $album = new Album;
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                $org_path = 'images/album/originals/' . $filename;
                $thm_path = 'images/album/thumbnails/' . $filename;
                $album->image     = $org_path;
                $album->thumbnail = $thm_path;
                $album->title     = $request->title;
                $album->status    = $request->status;
                if ( ! $album->save()) {
                    flash('Album could not be updated.')->error()->important();
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
        return redirect()->action('AlbumController@manage');
    }

    public function changephoto(Request $request)
    {
        //        dd($request->all());
        $this->validate($request, [
            'album_id' => 'required',
            'display_image' => 'required',
            'display_image.*' => 'image|mimes:jpeg,jpg,png,gif|max:750'
        ]);

        $this->album = Album::findorFail($request->album_id);
        if ($request->hasFile('display_image')) {
            $this->display_image = $request->file('display_image');
            $this->saveDisplayImage() ;
            $this->album->save();
        }
        return redirect()->back()->with('success','Album Display Image Updated successfully.');
       //return redirect()->action('ProductController@show', $this->product->id)->with('success','Display Updated successfully.');
    }

    public function saveDisplayImage()
    {
        $org_img = $thm_img = true;
        if( ! File::exists('images/album/originals/')) {
            $org_img = File::makeDirectory(public_path('images/album/originals/'), 0777, true);
        }
        if ( ! File::exists('images/album/thumbnails/')) {
            $thm_img = File::makeDirectory(public_path('images/album/thumbnails'), 0777, true);
        }

        $filename = rand(1111,9999).time().'.'.$this->display_image->getClientOriginalExtension();
        $org_path = 'images/album/originals/' . $filename;
        $thm_path = 'images/album/thumbnails/' . $filename;
        $this->album->display_image     = $org_path;
        $this->album->thumbnail = $thm_path;
            //$filename = str_slug($this->album->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();

            // upload image to server
            if (($org_img && $thm_img) == true) {
                Image::make($this->display_image)->fit(900, 500, function ($constraint) {
                        $constraint->upsize();
                    })->save($org_path);
                Image::make($this->display_image)->fit(270, 160, function ($constraint) {
                    $constraint->upsize();
                })->save($thm_path);
            }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
        $albums = Album::active()->get();
        return view('contentmanagement::albums.show',compact('album','albums'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
        $albums = Album::all();
        return view('contentmanagement::albums.edit', compact('albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
        $this->validate($request, [
            'label' => 'required',
            // 'job_description' => 'required'
        ]);
        if ( ! $album->update($request->all())) {
            return redirect()->back()->withInput()->withErrors('error', 'Error inserting the data..');
        }
       return redirect()->back()->with('success','Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        if($album->Photos->count() >0 )
        {
            return redirect()->back()->with('error','Cannot delete album with pictures.');
        }
        $album->delete();
        return redirect()->back()->with('success','Album deleted successfully.');
    }
}
