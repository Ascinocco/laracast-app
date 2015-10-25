@extends('app')

@section('content')
    <h1>Edit: {!! $article->title !!}</h1>

    <!--we use the patch method to send updates to articles(and other content)-->
    <!--When using 'action' to call a route you must specify the controller, the method -->
    <!--And any paramets you need to pass in an array as shown below-->
    <!--Form model binding: we use Form::model and pass in the $article in this case-->
    <!--This populates all our fields that match up to the model data-->
    {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id]]) !!}
        @include('articles.partials.form', ['submitButtonText' => 'Update Article'])
    {!! Form::close() !!}

            <!--views always have access to errors variable-->
    @include('errors.list')

@stop