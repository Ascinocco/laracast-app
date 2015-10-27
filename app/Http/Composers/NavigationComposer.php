<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 2015-10-27
 * Time: 15:32
 */

namespace App\Http\Composers;
use Illuminate\Contracts\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        //when laravel is composing the view partials.nav
        //do whats in the function closure
        $view->with('latest', \App\Article::latest()->first());

    }
}