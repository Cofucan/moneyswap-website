<?php

namespace Modules\ContentManagement\Traits;

use Illuminate\Http\Request;
use Modules\ContentManagement\Entities\Page;
// use Modules\LocationManagement\Traits\AddressTrait;
use Carbon\carbon;
use Illuminate\Support\Str;
use Session;
use File;
use Image;

trait PageTrait {
    // use AddressTrait;
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

     public function saveCoverImage()
    {
        //$display_image = $request->file('display_image');
        $org_img = $thm_img = true;
            if( ! File::exists('images/pages/originals/')) {
                $org_img = File::makeDirectory(public_path('images/pages/originals/'), 0777, true);
            }
            if ( ! File::exists('images/pages/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/pages/thumbnails'), 0777, true);
            }
            $filename = Str::slug($this->page->headline).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
            $org_path = 'images/pages/originals/' . $filename;
            $thm_path = 'images/pages/thumbnails/' . $filename;
            $this->page->display_image = 'images/pages/originals/'.$filename;
            $this->page->thumbnail = 'images/pages/thumbnails/'.$filename;
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
         if ( ! File::exists('images/pages/originals')) {
             $person_img = File::makeDirectory('images/pages/originals', 0777, true);
         }
         $filename = Str::slug($this->page->headline).'_'.time().'.'.$this->display_image->getClientOriginalExtension();
         $page_image = 'images/pages/originals/' . $filename;
         $this->page->display_image     = $page_image;
         // upload image to server
         Image::make($this->display_image)->fit('1500', '400', function ($constraint) {
             $constraint->upsize();
         })->save($page_image);
 
    }
    public function saveThumbnail()
    {
            // create new directory for uploading image if doesn't exist
            if ( ! File::exists('images/pages/thumbnails/')) {
                $page_img = File::makeDirectory('images/pages/thumbnails/', 0777, true);
            }
            $filename = Str::slug($this->page->headline).'_'.time().'.'.$this->thumbnail->getClientOriginalExtension();
            $thumbnail = 'images/pages/thumbnails/' . $filename;
            $this->page->thumbnail     = $thumbnail;
            // upload image to server
            Image::make($this->thumbnail)->save($thumbnail);

    }
    public function savePage()
    {        
                           
        $this->page =  new Page;           
        $this->page->headline = !empty($this->data['headline']) ? $this->data['headline'] : $this->headline;
        $this->page->body = $this->data['body'];
        $this->page->parent_id = !empty($this->data['parent_id']) ? $this->data['parent_id'] : '0';       
        $this->page->page_tag = !empty($this->data['page_tag']) ? $this->data['page_tag'] : NULL;
        $this->page->page_button = !empty($this->data['page_button']) ? $this->data['page_button'] : NULL;
        $this->page->button_link = !empty($this->data['button_link']) ? $this->data['button_link'] : NULL;
        $this->page->published = !empty($this->data['published']) ? $this->data['published'] : '0'; 
        if(isset($this->display_image))
        {
            $this->saveCoverImage() ;
        }
      
        if ( ! $this->page->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->page;
    }

    public function page($slug)
    {
        $page = Page::where('page_tag', !empty($slug) ? $slug : 'home')->firstOrFail();
        if($page->template =='landing')
        {
            return view('pages.landing', compact('page'));
        }
        return view('pages.page', compact('page'));
    }
  

}
