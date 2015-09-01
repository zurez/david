{{Form::open()}}
<input type="hidden" value="{{$token}}">
<input type="hidden" value="{{$username}}">
<input type="submit" value="Download">
{{Form::close()}}