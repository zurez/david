{{Form::open(array('files'=>true))}}
<input type="text" name="title" placeholder="TITLE">
<textarea name="desc" placeholder="DESCRIPTION"></textarea>
<input type="text" name="price" placeholder="PRICE">
<input type="file" name="script">

<input type="text" name="something" placeholder="SOMETHING ELSE"> 
<input type="submit" value="Create">
{{Form::close()}}