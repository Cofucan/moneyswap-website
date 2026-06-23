<?php

namespace App\Traits;


use App\Models\Post;
use App\Models\Classification;
use File;
use Image;
use Session;
use Carbon\carbon;
trait PostTrait {

    public function details($slug)
    {
        $classifications = Classification::all ();
        $recentposts = Post::active()->latest()->take(3)->get();
        $post = Post::where('slug', $slug)->first();
        $post->increment('visits');
        return view('posts.post', compact('post', 'classifications', 'recentposts'));
    }

    public function mypost()
    {
        $post = Post::where('user_id', Auth::id())->get();
        return view('posts.manage', compact('post'));
    }

    public function savePost()
    {
        $this->post = new Post;
        $this->post->visits = 0 ;
        $this->post->headline = $this->data['headline'] ;
        $this->post->story = $this->data['story'] ;
        $this->post->video = !empty($this->data['video']) ? $this->data['video'] : '';
        $this->post->post_source = !empty($this->data['post_source']) ? $this->data['post_source'] : '';
        $this->post->allow_comment = !empty($this->data['allow_comment']) ? $this->data['allow_comment'] : '0';
        $this->post->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $this->post->published = !empty($this->data['published']) ? $this->data['published'] : '0';
        if(isset($this->display_media))
        {
            $this->saveDisplayMedia() ;
        }

        if ( ! $this->post->save()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return $this->post;
    }

    public function activeClassifications()
    {
        return Classification::where('published', true)->pluck("label", "id");
    }

    
    public function saveClassification()
    {
        if(isset($this->data['classification_id']) || isset($this->classification_id))
        {
            $this->classification = Classification::findorFail(!empty($this->data['classification_id']) ? $this->data['classification_id'] : $this->classification_id);
        }else {
            $this->classification = new Classification;
        }
        $this->classification->label = $this->data['label'] ;
        $this->classification->published = !empty($this->data['published']) ? $this->data['published'] : '0';
        if ( ! $this->classification->save()) {
            return redirect()->back()->withInput()->with('error','Category entry error.');
        }
        return $this->classification;
    }

    public function saveDisplayMedia()
    {
            // create new directory for uploading image if doesn't exist
            //$display_media = $request->file('display_media');
            $org_img = $thm_img = true;
            if( ! File::exists('images/posts/originals/')) {
                $org_img = File::makeDirectory(public_path('images/posts/originals/'), 0777, true);
            }
            if ( ! File::exists('images/posts/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/posts/thumbnails'), 0777, true);
            }
            $filename = str_slug($this->post->headline).'_'.time().'.'.$this->display_media->getClientOriginalExtension();
            $org_path = 'images/posts/originals/' . $filename;
            $thm_path = 'images/posts/thumbnails/' . $filename;
            $this->post->display_media = 'images/posts/originals/'.$filename;
            $this->post->thumbnail = 'images/posts/thumbnails/'.$filename;
                if (($org_img && $thm_img) == true) {
                    Image::make($this->display_media)->fit(1500, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($this->display_media)->fit(300, 245, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                }
    }

    public function processPost()
    {
        $this->post = Post::findorFail(!empty($this->data['post_id']) ? $this->data['post_id'] : $this->post_id);
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;
        $this->post->status= $status;
        switch ($status){
            case "Scheduled":
        
            break;
            case "Approved":
                $this->post->date_published = Carbon::now();
                $this->post->published = '1';
            break;
            case "Rejected":
                
            break;

            }
            if($this->post->save()){
                //$this->registration->save();
                return $this->destination = 'posts.show';
            }
    }
    
}
