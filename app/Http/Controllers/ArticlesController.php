<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    //this fetches all the articles
    public function index()
    {
        //get all the data
        $articles = Article::all();

        return view ('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        //dd is die dump
        //dd($article);

        return view('articles.show', compact('article'));
    }
}
