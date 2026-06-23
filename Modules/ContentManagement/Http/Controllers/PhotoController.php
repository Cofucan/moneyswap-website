<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Photo;
use Modules\ContentManagement\Entities\Album;
use Modules\ContentManagement\Traits\PhotoTrait;
use File;
use Image;
use Session;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    use PhotoTrait;
    protected $photo;

    /**
     * [__construct description]
     * @param Photo $photo [description]
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function manage()
    {
        //
        $photos = Photo::all ();
        return view('contentmanagement::photos.manage', compact('photos'));
    }

    public function getownerlist(Request $request)
    {
        $owner_type = $request->owner_type;
        if($owner_type =='school')
        {
            $sectionables = DB::table("schools")->pluck("school_name","id");
        }elseif($owner_type =='page')
        {
            $sectionables = DB::table("pages")->pluck("content_title","id");
        }elseif($owner_type =='event')
        {
            $sectionables = DB::table("events")->pluck("label","id");
        }elseif($owner_type =='activity')
        {
            $sectionables = DB::table("activities")->pluck("activity_name","id");
        }elseif($owner_type =='facility')
        {
            $sectionables = DB::table("facilities")->pluck("label","id");
        }
        return response()->json($sectionables);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $albums = Album::active()->get();        
        $photos = Photo::paginate(12);
        return view('contentmanagement::photos.index', compact('photos', 'albums'));
    }

    // public function home($album = null)
    // {
    //     //
    //     $albums = Album::active()->get();        
    //     $photos = Photo::gallery($album = null)->paginate(12);
    //     return view('contentmanagement::photos.home', compact('photos', 'albums'));
    // }

    public function home()
    {
        //
        $albums = Album::active()->get();        
        $photos = Photo::gallery()->paginate(12);
        return view('contentmanagement::photos.home', compact('photos', 'albums'));
    }

    public function albumphoto(Album $album)
    {
        //
        $albums = Album::active()->get();        
        $photos = Photo::pictures($album)->paginate(12);     
        return view('contentmanagement::photos.album', compact('album', 'albums', 'photos'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $albums = Album::all()->pluck("album_name", "id");
        return view('contentmanagement::photos.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //        dd($request->all());
    //     $this->validate($request, [
    //         // 'owner_type' => 'required',
    //         // 'owner_id' => 'required',           
    //         'display_media' => 'required'
    //     ]);
        
    //    $this->data = $request->all(); 
    // //    $this->photo = new Photo; 
    //     if (!$this->AddImages()) {
    //         return redirect()->back()->with('error', 'Images could not be uploaded');          
    //     }
    //     return redirect()->back()->with('success', 'Images Added Successfully');
    // }
    public function store(Request $request)
    {
        //
        $request->validate([
            'album_id' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048'
        ]);
        //dd($request->all());
        //check if image exist 
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                //create new instance of Photo class
                $newPhoto = new $this->photo;
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
                $newPhoto->file_path     = $org_path;
                $newPhoto->thumbnail = $thm_path;
                $newPhoto->album_id = $request->album_id;
                //don't upload file when unable to save name to database
                if ( ! $newPhoto->save()) {
                    return false;
                }
                // upload image to server
                if (($org_img && $thm_img) == true) {
                   Image::make($image)->save($org_path);
                   Image::make($image)->fit(400, 300, function ($constraint) {
                       $constraint->upsize();
                   })->save($thm_path);
                }
            }
        }
        return redirect()->back()->with('success','Image added successfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
        $photo->delete();
         return redirect()->back()
                         ->with('success','Image deleted successfully');
    }
}
