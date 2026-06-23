<?php

namespace Modules\ContentManagement\Traits;

use Illuminate\Http\Request;
use Modules\ContentManagement\Entities\Photo;
use Modules\CalendarManagement\Entities\Event;
use File;
use Image;
use Storage;

trait PhotoTrait {

   /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    
 
    public function AddImages()
    {
        $display_media = $this->data['display_media'];        
        $org_img = $thm_img = true;            
        if( ! File::exists('images/photos/originals/')) {
            $org_img = File::makeDirectory('images/photos/originals/', 0777, true);
        }
        if ( ! File::exists('images/photos/thumbnails/')) {
            $thm_img = File::makeDirectory('images/photos/thumbnails', 0777, true);
        }            
        foreach($display_media as $key => $media) {                  
            $this->photo = new Photo;                 
            $filename = rand(1111,9999).time().'.'.$media->getClientOriginalExtension();                  
            $org_path = 'images/photos/originals/' . $filename;
            $thm_path = 'images/photos/thumbnails/' . $filename;
            $this->photo->file_path     = $org_path;
            $this->photo->thumbnail = $thm_path;
            $this->photo->published = true;
            $owner_type = !empty($this->data['owner_type']) ? $this->data['owner_type'] : $this->owner_type;
            switch ($owner_type)
            {
                case "events":
                $this->event = Event::findOrFail($this->data['owner_id']);
                    if(!$this->event->Photos()->save($this->photo)){
        
                    }                        
                break;
                case "clubs":
                $this->club = Club::findOrFail($this->data['owner_id']);
                $this->club->Photos()->save($this->photo);
                break;
                default:
                $this->photo->save();  
            }
            
            // upload image to server
            if (($org_img && $thm_img) == true) {
            Image::make($media)->fit(1000, 1000, function ($constraint) {
                    $constraint->upsize();
                })->save($org_path);
            Image::make($media)->fit(400, 400, function ($constraint) {
                $constraint->upsize();
            })->save($thm_path);
            }
        }
    return true;
    }
   

}
