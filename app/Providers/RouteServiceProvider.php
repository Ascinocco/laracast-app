<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //once the laravel app is bootstraped and ready to do the following

        parent::boot($router);

        //note: doing this isn't necessary and in some cases may
        // be inappropriate to do

        //here we are binding the specific route wildcard to the
        //Article Model
        //Note: to view wildcards use the route:list command
        //wildcards go inbetween {} ex /articles/{wildcard}
        //$router->model('articles', 'App\Article');

        $router->bind('articles', function($id){
            return \App\Article::published()->findOrFail($id);
        });

        $router->bind('tags', function($name){
            return \App\Tag::where('name', $name)->findOrFail($name);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
