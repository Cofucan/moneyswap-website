<?php

namespace Modules\CatalogManagement\Traits;

use Illuminate\Http\Request;
use Modules\CatalogManagement\Entities\Expertise;
// use Modules\LocationManagement\Traits\AddressTrait;
use Carbon\carbon;
use Illuminate\Support\Str;
use Session;
use File;
use Image;

trait ExpertiseTrait {
    // use AddressTrait;
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveExpertise()
    {
      
        $this->expertise = new Expertise;  
        $this->expertise->label = $this->data['label'];
        $this->expertise->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->expertise->display_order = !empty($this->data['display_order']) ? $this->data['display_order'] : '1';              
        if(isset($this->display_image))
        {
            $this->saveCoverImage() ;
        }
        if ( ! $this->expertise->save()) {           
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->expertise;
    } 

    public function saveCoverImage()
    {
        //$display_image = $request->file('display_image');
        $org_img = $thm_img = true;
            if( ! File::exists('images/expertises/originals/')) {
                $org_img = File::makeDirectory(public_path('images/expertises/originals/'), 0777, true);
            }
            if ( ! File::exists('images/expertises/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/expertises/thumbnails'), 0777, true);
            }
            $filename = Str::slug($this->expertise->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
            $org_path = 'images/expertises/originals/' . $filename;
            $thm_path = 'images/expertises/thumbnails/' . $filename;
            $this->expertise->display_image = 'images/expertises/originals/'.$filename;
            $this->expertise->thumbnail = 'images/expertises/thumbnails/'.$filename;
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
         if ( ! File::exists('images/expertises/originals')) {
             $person_img = File::makeDirectory('images/expertises/originals', 0777, true);
         }
         $filename = Str::slug($this->expertise->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
         $expertise_image = 'images/expertises/originals/' . $filename;
         $this->expertise->display_image     = $expertise_image;
         // upload image to server
         Image::make($this->display_image)->fit('1500', '400', function ($constraint) {
             $constraint->upsize();
         })->save($expertise_image);
 
    }
    public function saveThumbnail()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/expertises/thumbnails/')) {
                $expertise_img = File::makeDirectory('images/expertises/thumbnails/', 0777, true);
            }
            $filename = Str::slug($this->expertise->label).'_'.time().'.'.$this->thumbnail->getClientOriginalExtension();
            $thumbnail = 'images/expertises/thumbnails/' . $filename;
            $this->expertise->thumbnail     = $thumbnail;
            // upload image to server
            Image::make($this->thumbnail)->save($thumbnail);

    }
  

}
