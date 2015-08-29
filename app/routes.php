<?php


Route::get('/',function(){
	return "Reached";
});
Route::group(array('before' => 'auth'), function(){
Route::get('admin',array('as'=>'admin','uses'=>'AdminController@index'));

});
Route::get('product',array('as'=>'product','uses'=>'ProductController@index'));
Route::get('buy/{id}/paypal',array('as' =>'buy' ,'uses'=>'PaypalController@index' ));
Route::post('buy/{id}/paypal',array('as' =>'buy' ,'uses'=>'PaypalController@redirect' ));

Route::get('order/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));