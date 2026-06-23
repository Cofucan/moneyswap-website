<?php

namespace Modules\CatalogManagement\Traits;

use Illuminate\Http\Request;
use Modules\CatalogManagement\Entities\Feature;
use Carbon\carbon;
use Illuminate\Support\Str;
use Session;
use File;
use Image;

trait FeatureTrait {
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveFeature()
    {
      
        $this->feature = new Feature;  
        $this->feature->label = $this->data['label'];
        $this->feature->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';             
        if(isset($this->display_image))
        {
            $this->saveCoverImage() ;
        }
        if ( ! $this->feature->save()) {           
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->feature;
    } 

    public function saveCoverImage()
    {
        //$display_image = $request->file('display_image');
        $org_img = $thm_img = true;
            if( ! File::exists('images/features/originals/')) {
                $org_img = File::makeDirectory(public_path('images/features/originals/'), 0777, true);
            }
            if ( ! File::exists('images/features/icons/')) {
                $thm_img = File::makeDirectory(public_path('images/features/icons'), 0777, true);
            }
            $filename = Str::slug($this->feature->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
            $org_path = 'images/features/originals/' . $filename;
            $thm_path = 'images/features/icons/' . $filename;
            $this->feature->display_image = 'images/features/originals/'.$filename;
            $this->feature->icon = 'images/features/icons/'.$filename;
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
         if ( ! File::exists('images/features/originals')) {
             $person_img = File::makeDirectory('images/features/originals', 0777, true);
         }
         $filename = Str::slug($this->feature->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
         $feature_image = 'images/features/originals/' . $filename;
         $this->feature->display_image     = $feature_image;
         // upload image to server
         Image::make($this->display_image)->fit('1500', '400', function ($constraint) {
             $constraint->upsize();
         })->save($feature_image);
 
    }
    public function saveIcon()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/features/icons/')) {
                $feature_img = File::makeDirectory('images/features/icons/', 0777, true);
            }
            $filename = Str::slug($this->feature->label).'_'.time().'.'.$this->icon->getClientOriginalExtension();
            $icon = 'images/features/icons/' . $filename;
            $this->feature->icon     = $icon;
            // upload image to server
            Image::make($this->icon)->save($icon);

    }
  

}
