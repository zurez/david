{{Form::open()}}
{{Form::text()}}
<input type="hidden" name="product" value="{{$id}}">
{{Form::submit()}}
{{Form::close()}}