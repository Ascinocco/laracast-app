<?php

Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');

//Route::get('articles', 'ArticlesController@index');
//Route::get('articles/create', 'ArticlesController@create');
//any routes with wildcards({id}) must come last or they overwrite
//other paths beneath them as the path is seen as a wildcard as well
//Route::get('articles/{id}', 'ArticlesController@show');

//post(and other types of request just not get) requests
// can come after the wild card
//calling the Route via the post method implements REST not sure how...
//Route::post('articles', 'ArticlesController@store');

//route resource takes car of the above excluding the static pages
Route::resource('articles', 'ArticlesController');

//the following method registers multiple routes to multiple controllers
//i think
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);