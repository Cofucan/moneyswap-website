<?php

namespace Modules\MediaManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\MediaManagement\Entities\Attachment;
use Modules\MediaManagement\Traits\AttachmentTrait;
use Modules\CatalogManagement\Entities\Price;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    use AttachmentTrait;
    public function singlecreate()
    {
        //
        return view('mediamanagement::attachments.singleimage');
    }

    public function savemultiple(Request $request)
    {
        request()->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($image = $request->file('image')) {
            foreach ($image as $files) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert[]['image'] = "$profileImage";
            }
        }

        $check = Image::insert($insert);

        return Redirect::to("image")->withSuccess('Great! Image has been successfully uploaded.');

    }

    public function upload(Request $request)
    {
      $uploadedFile = $request->file('file');
      $filename = time().$uploadedFile->getClientOriginalName();
      Storage::disk('local')->putFileAs(
        'files/'.$filename,
        $uploadedFile,
        $filename
      );

      $upload = new Upload;
      $upload->filename = $filename;
      $upload->user()->associate(auth()->user());
      $upload->save();
      return response()->json([
        'id' => $upload->id
      ]);
    }

public function uploadSubmit(Request $request)
{
    $this->validate($request, [
    'name' => 'required',
    'photos'=>'required',
    ]);
    if($request->hasFile('photos'))
    {
        $allowedfileExtension=['pdf','jpg','png','docx'];
        $files = $request->file('photos');
        foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
            //dd($check);
            if($check){
                $prices= Price::create($request->all());
                foreach ($request->photos as $photo) {
                $filename = $photo->store('photos');
                ItemDetail::create([
                'item_id' => $prices->id,
                'filename' => $filename
                ]);
                }
            echo "Upload Successfully";
            }
            else
            {
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
            }
        }
    }
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('mediamanagement::attachments.image');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mediamanagement::attachments.create');
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
        'attachment' => 'required',
        'attachable_type' => 'required',
        'live_date' => 'required',
        'filename.*' => 'mimes:doc,pdf,docx, png,jpg'
    ]);
    $this->data = $request->all();
    $this->attachment = new Attachment;
    $this->attachment->academic_term_id = $this->data['academic_term_id'];
    $this->attachment->label = $this->data['label'];
    $this->attachment->live_date = $this->data['live_date'];
    $this->attachment->start_time = $this->data['start_time'];
    $this->attachment->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
    $this->attachment->duration_minutes = !empty($this->data['duration_minutes']) ? $this->data['duration_minutes'] : 50;
    $this->attachment->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
    switch ($request->attachable_type){
        case "subject":
            $subject = Subject::findOrFail($request->liveable_id);
            $this->attachment->access_code = $subject->slug;
            if ( ! $subject->Lives()->save($this->attachment)) {
                return redirect()->back()->withInput()->withErrors('Could not schedule attachment lesson for the subject, contact the admin');
            }
            break;
        case "classroom":
            $classroom = Classroom::findOrFail($request->liveable_id);
            $this->attachment->access_code = $classroom->slug;
            if ( ! $classroom->Lives()->save($this->attachment)) {
                return redirect()->back()->withInput()->withErrors('Could not schedule attachment lesson for the subject, contact the admin');
            }
        break;
        case "profile_type":
            $roleCategory = RoleCategory::find($request->liveable_id);
            $this->attachment->access_code = $roleCategory->slug;
            if ( ! $classroom->Lives()->save($this->attachment)) {
                return redirect()->back()->withInput()->withErrors('Could not schedule attachment lesson for the subject, contact the admin');
            }
        break;
        default:
        $this->attachment->save();
        }
    return redirect()->route('lives.preview', $this->attachment->id)->with('success',' Updated successfully.');


    if($request->hasfile('filename'))
     {
        foreach($request->file('filename') as $file)
        {
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
//            $filename = $photo->store('photos');
            $file_url = $file->move(public_path().'/files/', $name);
            $data[] = $name;
        }
     }

     $attachment= new Attachment();
     $attachment->file_name=json_encode($data);

    $attachment->save();

    return back()->with('success', 'Your files has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
        return view('mediamanagement::attachments.show', compact('attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        //
        $attachment->delete();
        return redirect()->back()
                        ->with('success','attachment deleted successfully');
    }
}
