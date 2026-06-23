<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cause;
class SwapWallet extends Component
{
    public $blog_title;
    public $slug;

   

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Blog::class, 'slug', $this->blog_title);
    }

    public function store()
    {
        Blog::create([
            'blog_title' => $this->blog_title,
            'slug'  => $this->slug
        ]);
    }    
    public function render()
    {
        $causes = Cause::latest()->take(7)->get();
        return view('livewire.swap-cause', compact('causes'));
    }
}
