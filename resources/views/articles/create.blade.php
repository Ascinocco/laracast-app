@extends('app')

@section('content')
    <h1>Write a new Article</h1>

    <hr/>

    <!--Remember: By default(Form::open()), the form submits a post request to-->
    <!--the same page/route-->
    <!--specifiying the array 'url' => 'articles' tells the app the route-->
    <!--to pass the data to, again by the POST method-->
    {!! Form::open(['url' => 'articles']) !!}
        @include('articles.partials.form', ['submitButtonText' => 'Create Article'])
    {!! Form::close() !!}

    @include('errors.list')

    <!--GOOD NOTES ON HOW Illuminate/Html/FormFacade WORKS BELOW-->
    <!--{!! Form::open() !!}-->
        <!--<div class="form-group">-->
            <!--The first attribute of the form label is the name which happens-->
            <!--to be name, the second attribute is what goes between the label-->
            <!--tags in html, in this case 'Name:'-->
            <!--{!! Form::label('name', 'Name:') !!}-->
            <!--giving a parameter of name here assigns the name to name and the-->
            <!--id to name and ofcourse the type is text as we've specified after-->
            <!-- the class name/ object access notation -->
            <!--Also, null is where the default value goes, and the array-->
            <!--that is in the third param position provides addition html-->
            <!--attributes as specified, in this case class => form-control-->
            <!--is equal to class="form-control" and I'm sure you can add more-->
            <!--{!! Form::text('name', null, ['class' => 'form-control']) !!}-->
        <!--</div>-->
    <!--{!! Form::close() !!}-->
@stop