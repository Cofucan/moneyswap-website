<?php

namespace Modules\MediaManagement\Traits;

use Illuminate\Http\Request;
use Modules\MediaManagement\Entities\Attachment;
use Modules\CalendarManagement\Entities\Event;
use File;
use Image;
use Storage;

trait AttachmentTrait {

    public function download(Attachment $attachment){
        return Storage::download($attachment->media_url, $attachment->file_name); // $name and $headers are optional
     }

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStoreImage(Request $request, $fieldname = 'image', $directory = 'unknown' ) {

        if( $request->hasFile( $fieldname ) ) {
            if (!$request->file($fieldname)->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
            return $request->file($fieldname)->store('image/' . $directory, 'public');
        }

        return null;

    }

    public function displayImage($filename)

    {

        $path = storage_public('images/' . $filename);

        if (!File::exists($path)) {

            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
    public function Attachit($toupload)
    {
        $attachment = new Attachment;
        $attachment->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        if (!File::exists($toupload)) {
            $attachment->media_type = 'link';
            $attachment->file_name = 'External Link';
            $attachment->media_url = !empty($this->data['media_url']) ? $this->data['media_url'] : $toupload;
        }else{
        $attachment->file_name = !empty($toupload->getClientOriginalName()) ? $toupload->getClientOriginalName() : 'External Link';
        $attachment->media_type = !empty(strtolower($toupload->getClientOriginalExtension())) ? strtolower($toupload->getClientOriginalExtension()) : 'link';
        $image_extensions = array("jpg","jpeg","png","gif","bmp","svg");
        $document_extensions = array("doc","pdf","docx","xls","xlsx","ppt","pptx","csv");
        $multimedia_extensions = array("mp3","avi","wma","wma","mp4");
        $directory = !empty($this->data['attachable_type']) ? $this->data['attachable_type'] : 'attachments';

        if(in_array($attachment->media_type,$image_extensions)){
            $org_img = $thm_img = true;
            $location = 'images';
            $destination = $directory.'/'.$location;
            if( !File::exists($destination.'/')) {
            $destination = File::makeDirectory($destination, 0777, true);
            }
            $filename = time().'.'.$toupload->getClientOriginalExtension();
            $thumbnail = $destination.'/'.$filename;
            $attachment->thumbnail = $thumbnail;
            Image::make($toupload)->fit('250', '250', function ($constraint) {
                    $constraint->upsize();
                })->save($thumbnail);

        }elseif(in_array($attachment->media_type,$document_extensions)){
            $location = 'docs';
        }elseif(in_array($attachment->media_type,$multimedia_extensions)){
            $location = 'media';
        }
        $attachment->media_url = $toupload->store($directory.'/' . $location, 'public');
        }
        return $attachment;

    }


    public function Attachall($uploads)
    {
        foreach ($uploads as $toupload) {
            $paths[]   = $this->Attachit($toupload);
        }
        return $paths;
    }

    public function saveAttachment(Request $request)
    {
        $attachment = new Attachment;
        $attachment->file_name = $toupload->getClientOriginalName();
        $attachment->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $attachment->attachment_url = $request->file($attachment)->store('image/' . $directory, 'public');
        $attachment->media_type = $toupload->getMimeType() ;
        return $attachment;
        // File Details
        //$extension = $file->getClientOriginalExtension();
        //$fileSize = $file->getSize();
        if( $request->hasFile( $attachment) ) {
            if (!$request->file($attachment)->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }

        }
    }
    public function verifyAndStoreMedia( Request $request, $catalogable_type, $catalogable_id) {

        if ($request->hasFile('catalogmedium')) {
            $catalogmedium = $request->file('catalogmedium');
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/catalogmedium/originals/')) {
                $org_img = File::makeDirectory('images/catalogmedium/originals/', 0777, true);
            }
            if ( ! File::exists('images/catalogmedium/thumbnails/')) {
                $thm_img = File::makeDirectory('images/catalogmedium/thumbnails', 0777, true);
            }
            // loop through each image to save and upload
            foreach($this->catalog_media as $key => $media) {
                //create new instance of Photo class
                $catalogmedium = new RealtyAsset;
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$media->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/catalogmedium/originals/' . $filename;
                $thm_path = 'images/catalogmedium/thumbnails/' . $filename;
                $catalogmedium->display_medium     = $org_path;
                $catalogmedium->thumbnail = $thm_path;
                $catalogmedium->published = true;

                if($catalogable_id > 0)
                {
                    switch ($catalogable_type){
                        case "product":
                            $product = Product::find($request->catalogable_id);
                            $product->CatalogMedia()->save($catalogmedium);
                            break;
                        case "variation":
                            $variation = Variation::find($request->catalogable_id);
                            $variation->CatalogMedia()->save($catalogmedium);
                            break;
                        case "event":
                            $event = Event::find($request->catalogable_id);
                            $event->CatalogMedia()->save($catalogmedium);
                            break;

                        default:
                        $catalogmedium->save();
                        }
                }
                // upload image to server
                if (($org_img && $thm_img) == true) {
                Image::make($media)->fit(900, 500, function ($constraint) {
                        $constraint->upsize();
                    })->save($org_path);
                Image::make($media)->fit(270, 160, function ($constraint) {
                    $constraint->upsize();
                })->save($thm_path);
                }
            }
        }else {
            return false;
        }
        return null;

    }





    public function AddAttachments()
    {
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/catalogmedia/originals/')) {
                $org_img = File::makeDirectory('images/catalogmedia/originals/', 0777, true);
            }
            if ( ! File::exists('images/catalogmedia/thumbnails/')) {
                $thm_img = File::makeDirectory('images/catalogmedia/thumbnails', 0777, true);
            }
            // loop through each image to save and upload
            foreach($this->catalogmedia as $key => $media) {
                //create new instance of Photo class
                $catalogmedium = new CatalogMedium;
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$media->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/catalogmedia/originals/' . $filename;
                $thm_path = 'images/catalogmedia/thumbnails/' . $filename;
                $catalogmedium->display_medium     = $org_path;
                $catalogmedium->thumbnail = $thm_path;
                $catalogmedium->published = true;
                //$catalogmedium->medium_title = true;
                $this->product->CatalogMedia()->save($catalogmedium);

                // upload image to server
                if (($org_img && $thm_img) == true) {
                Image::make($media)->fit($this->org_width, $this->org_height, function ($constraint) {
                        $constraint->upsize();
                    })->save($org_path);
                Image::make($media)->fit($this->thm_width, $this->thm_height, function ($constraint) {
                    $constraint->upsize();
                })->save($thm_path);
                }
            }
    }



}
