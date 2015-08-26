<?php


Route::get('/',function(){
	return "Reached";
});

Route::get('admin',array('as'=>'admin','uses'=>'AdminController@index'));
Route::get('product',array('as'=>'product','uses'=>'ProductController@index'));