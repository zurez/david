
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		@import url(http://fonts.googleapis.com/css?family=Covered+By+Your+Grace);
*, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}

body {
  padding: 5em 1em;
  
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

h1 {
  text-align: center;
  font-size: 275%;
  font-family: 'Covered By Your Grace', cursive;
  font-weight: 300;
  margin-top: -1em;
  text-shadow: 0 2px 1px white;
}

#box {
  margin: auto;
  width: 50em;
  height: 100%;
  white-space: nowrap;
}
@media all and (max-width: 52em) {
  #box {
    width: 100%;
  }
}

#center {
  vertical-align: middle;
  display: inline-block;
  white-space: normal;
}

#box:after {
  content: "";
  width: 1px;
  height: 100%;
  vertical-align: middle;
  display: inline-block;
  margin-right: -10px;
}

table {
  background-color: white;
  padding: 1em;
}
table, table * {
  border-color: #27ae60 !important;
}
table th {
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  color: white;
  background-color: #27ae60;
  position: relative;
}
table th:after {
  content: "";
  display: block;
  height: 5px;
  right: 0;
  left: 0;
  bottom: 0;
  background-color: #16a085;
  position: absolute;
}

#credits {
  text-align: right;
  color: white;
}
#credits a {
  color: #16a085;
  text-decoration: none;
}
#credits a:hover {
  text-decoration: underline;
}

	</style>
</head>
<body>
	<div id="box">
<main id="center">
  <h1>Product Page</h1>
  <p>{{ link_to_route('create', 'Add new product') }}</p>
  <table class="pure-table pure-table-horizontal">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
       
    
        <th>Price</th>
        <th>Buy</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
    <tr>
    <td>{{$product->title}}</td>
    <td>{{$product->description}}</td>
    <td>${{$product->price}}</td>
    <td>{{ link_to_route('edit', 'Edit',array($product->id), array('class' => 'btn btn-info')) }}</td></td>
    <td>{{ link_to_route('destroy', 'Delete',array($product->id), array('class' => 'btn btn-info')) }}</td></td>
    </tr>
    @endforeach
      
    </tbody>
  </table>
</main>
</div>

</body>
</html>