<?php

namespace Modules\CatalogManagement\Traits;

use Illuminate\Http\Request;
use Modules\CatalogManagement\Entities\Cause;
// use Modules\LocationManagement\Traits\AddressTrait;
use Carbon\carbon;
use Illuminate\Support\Str;
use Session;
use File;
use Image;

trait CauseTrait {
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveCause()
    {

        $this->cause = new Cause;
        $this->cause->label = $this->data['label'];
        $this->cause->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->cause->display_order = !empty($this->data['display_order']) ? $this->data['display_order'] : '1';
        if(isset($this->display_image))
        {
            $this->saveCoverImage() ;
        }
        if ( ! $this->cause->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->cause;
    }

    public function saveCoverImage()
    {
        //$display_image = $request->file('display_image');
        $org_img = $thm_img = true;
            if( ! File::exists('images/causes/originals/')) {
                $org_img = File::makeDirectory(public_path('images/causes/originals/'), 0777, true);
            }
            if ( ! File::exists('images/causes/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/causes/thumbnails'), 0777, true);
            }
            $filename = Str::slug($this->cause->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
            $org_path = 'images/causes/originals/' . $filename;
            $thm_path = 'images/causes/thumbnails/' . $filename;
            $this->cause->display_image = 'images/causes/originals/'.$filename;
            $this->cause->thumbnail = 'images/causes/thumbnails/'.$filename;
            if (($org_img && $thm_img) == true) {
                Image::make($this->display_image)->fit(1500, 400, function ($constraint) {
                        $constraint->upsize();
                    })->save($org_path);
                Image::make($this->display_image)->fit(300, 300, function ($constraint) {
                    $constraint->upsize();
                })->save($thm_path);
            }
    }

    public function saveDisplayImage()
    {
             // create new directory for uploading image if doesn't exist
         if ( ! File::exists('images/causes/originals')) {
             $person_img = File::makeDirectory('images/causes/originals', 0777, true);
         }
         $filename = Str::slug($this->cause->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
         $expertise_image = 'images/causes/originals/' . $filename;
         $this->cause->display_image     = $expertise_image;
         // upload image to server
         Image::make($this->display_image)->fit('1500', '400', function ($constraint) {
             $constraint->upsize();
         })->save($expertise_image);

    }
    public function saveThumbnail()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/causes/thumbnails/')) {
                $expertise_img = File::makeDirectory('images/causes/thumbnails/', 0777, true);
            }
            $filename = Str::slug($this->cause->label).'_'.time().'.'.$this->thumbnail->getClientOriginalExtension();
            $thumbnail = 'images/causes/thumbnails/' . $filename;
            $this->cause->thumbnail     = $thumbnail;
            // upload image to server
            Image::make($this->thumbnail)->save($thumbnail);

    }


}
