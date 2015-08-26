@foreach ($products as $product) 
	{{$product->title}}<br>
	{{$product->description}}
@endforeach