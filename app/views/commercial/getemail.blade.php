{{Form::open()}}

<input type="text" name="email" placeholder="Enter your email">
<input type="hidden" name="product" value="{{$id}}">
{{Form::submit()}}
{{Form::close()}}

 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif