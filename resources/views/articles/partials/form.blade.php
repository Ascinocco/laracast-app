<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('published_at', 'Publish On:') !!}
            <!--When using the genric input we must specify the type which-->
    <!--in this case is 'date'-->
    <!--also the input box defaults to todays date-->
    {!! Form::input('date', 'published_at', $article->published_at, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tag_list', 'Tags:') !!}
    <!--since multiple tags can be selected we need to specifiy that-->
    <!--tags[] is an array with the [] notation-->
    {!! Form::select('tag_list[]', $tags, null,['id' => 'tag_list','class' => 'form-control', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')
<script>
    $('#tag_list').select2({
        placeholder: 'Choose a tag'
    });

</script>
@endsection