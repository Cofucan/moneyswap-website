<?php

namespace Modules\OrganizationManagement\Traits;

use Illuminate\Http\Request;
use Modules\OrganizationManagement\Entities\Industry;
// use Modules\LocationManagement\Traits\AddressTrait;
use Carbon\carbon;
use Illuminate\Support\Str;
use Session;
use File;
use Image;

trait IndustryTrait {
    // use AddressTrait;
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveIndustry()
    {

        $this->industry = new Industry;
        $this->industry->label = $this->data['label'];
        $this->industry->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        //$this->industry->display_order = !empty($this->data['display_order']) ? $this->data['display_order'] : '1';
        if(isset($this->display_image))
        {
            $this->saveCoverImage() ;
        }
        if ( ! $this->industry->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->industry;
    }

    public function saveCoverImage()
    {
        //$display_image = $request->file('display_image');
        $org_img = $thm_img = true;
            if( ! File::exists('images/industries/originals/')) {
                $org_img = File::makeDirectory(public_path('images/industries/originals/'), 0777, true);
            }
            if ( ! File::exists('images/industries/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/industries/thumbnails'), 0777, true);
            }
            $filename = Str::slug($this->industry->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
            $org_path = 'images/industries/originals/' . $filename;
            $thm_path = 'images/industries/thumbnails/' . $filename;
            $this->industry->display_image = 'images/industries/originals/'.$filename;
            $this->industry->thumbnail = 'images/industries/thumbnails/'.$filename;
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
         if ( ! File::exists('images/industries/originals')) {
             $person_img = File::makeDirectory('images/industries/originals', 0777, true);
         }
         $filename = Str::slug($this->industry->label).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
         $expertise_image = 'images/industries/originals/' . $filename;
         $this->industry->display_image     = $expertise_image;
         // upload image to server
         Image::make($this->display_image)->fit('1500', '400', function ($constraint) {
             $constraint->upsize();
         })->save($expertise_image);

    }
    public function saveThumbnail()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/industries/thumbnails/')) {
                $expertise_img = File::makeDirectory('images/industries/thumbnails/', 0777, true);
            }
            $filename = Str::slug($this->industry->label).'_'.time().'.'.$this->thumbnail->getClientOriginalExtension();
            $thumbnail = 'images/industries/thumbnails/' . $filename;
            $this->industry->thumbnail     = $thumbnail;
            // upload image to server
            Image::make($this->thumbnail)->save($thumbnail);

    }


}
