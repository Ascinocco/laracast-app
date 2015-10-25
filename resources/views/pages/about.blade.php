@extends('app')

@section('content')
<h1>About Me: {{$name}}</h1>

<!--if the array has values in it-->
@if(count($people))
    <h3>People I like: </h3>
    <ul>
        @foreach($people as $person)
         <li>{{$person}}</li>
        @endforeach
    </ul>
@endif

<p>Some text goes here</p>
@stop