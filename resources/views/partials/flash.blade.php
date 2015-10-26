<!--display our flash message-->
<!--do we have this key in the session? if so {...}-->
@if (Session::has('flash_message'))
    <div class="alert alert-success {{Session::has('flash_message_important') ? 'alert-important' : ''}}">
        @if(Session::has('flash_message_important'))
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @endif
                    <!--this is the same as using Session::get('flash_message')-->
            {{ session('flash_message') }}
    </div>
@endif