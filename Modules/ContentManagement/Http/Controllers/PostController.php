<?php

namespace Modules\ContentManagement\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\ContentManagement\Entities\Post;
use Modules\ContentManagement\Traits\PostTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use File;
use Image;
use Carbon\carbon;
use Auth;

class PostController extends Controller
{
    use PostTrait;
    public function popular()
    {
        $posts = Post::popular()
            ->createdAfter(Carbon::now()->subMonth())
            ->limit(5)
            ->get();
    }

    public function toggle(Post $post)
    {
        if ($post->published == 1) {
            $post->published = 0;
            $feedback = 'Post Unpublished successfully';
        } else {
            $post->published = 1;
            $post->status = 'Approved';
            $feedback = 'Post Unpublished successfully';
        }
        if ( ! $post->save()) {
            return redirect()->back()->with('error', 'Could not update Post');
        }
        return redirect()->back()->with('success', $feedback);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all ();
        return view('contentmanagement::posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $posts = Post::all();
        $classifications= $this->activeClassifications();
        return view('contentmanagement::posts.create', compact('classifications','posts'));
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
            'headline' => 'required',
            'story' => 'required',
            'display_media' => 'required',
            'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:2000'
        ]);
        $this->data = $request->all();
        if ($request->hasFile('display_media')) {
            $this->display_media = $request->file('display_media');
        }
        if ( !$this->savePost()) {
            return redirect()->back()->withInput()->with('error', 'Error inserting the data..');
        }
        if(isset($request->classifications))
        {
            $this->post->Classifications()->sync($request->classifications);
        }
       return redirect()->route('posts.show', $this->post->id)->with('success','Post Added successfully.');
    }

    public function changestatus(Request $request, Post $post)
    {
        $post = Post::findOrFail($request->id);
        if ($post->published == 1) {
            $post->published = 0;
            $published = 'Not Published';
        } else {
            $post->published = 1;
            $published = 'Published';
        }
        if ( ! $post->save()) {
            Session::flash('error', 'Record status could not be changed.');
            return redirect()->route('managePosts');
        }
        Session::flash('success', 'Status has been updated successfully '.$published);
        return redirect()->route('managePosts');
    }

    public function manage()
    {
        //
        $posts = Post::all();
        return view('contentmanagement::posts.manage', compact('posts'));
    }
    public function process(Request $request)
    {
        $this->validate($request, [
           'post_id' => 'required',
            'status' => 'required'
        ]);
        $this->data = $request->all();
        if($this->processPost())
        {
            return redirect()->back()->with('success','Action performed successfully.');
        }

    }
    public function addClassifications(Request $request)
    {
        $this->validate($request, [
            'classifications' => 'required',
            'post_id' => 'required'
        ]);
        $post = Post::findorFail($request->post_id);
        if(!$post->Classifications()->attach($request->classifications))
        {
            return redirect()->back()->with('error','Could not attach post to categories.');
        }
        return redirect()->route('posts.show', $post->id)->with('success','Post added to categories successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('contentmanagement::posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $classifications= $this->activeClassifications();
         return view('contentmanagement::posts.edit',compact('post', 'classifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $this->validate( $request, [
            'headline' => 'required',
            'story' => 'required',
            'display_media.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ]);

        if ( !$this->post->update($request->all())) {
            return redirect()->back()->withInput()->with('error', 'Error Updating post post.');
        }
       return redirect()->route('posts.show', $this->post->id)->with('success','Post Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->Classifications()->detach();
        $post->delete();
         return redirect()->back()
                         ->with('success','Post deleted successfully');
    }
}
