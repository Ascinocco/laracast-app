@extends('app')

@section('content')
    <h1>Articles</h1>

    @foreach($articles as $article)

        <article>
            <h2>
                <!--The action helper function allows use to specify the controller-->
                <!--and function we want along with the $article id as a parameter-->
                <!--This specifies I want the ArticlesController witht he show method-->
                <!--The the article id is passed to the show method inside an array-->
                <a href="{{action('ArticlesController@show', [$article->id])}}">
                    {{$article->title}}
                </a>
            </h2>

            <div class="body">{{$article->body}}</div>
        </article>

    @endforeach

@stop