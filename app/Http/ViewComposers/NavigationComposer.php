<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Navigation;

class NavigationComposer
{
    
    

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //
        $view->with('navigation', Navigation::all());
        //$view->with('latestMovie', end($this->movieList));
    }
}