<?php


Route::get('/',function(){
	return "Reached";
});
//Login
// route to show the login form
Route::get('login', array('uses' => 'DownloadController@showLogin'));
Route::get('logout', array('uses' => 'DownloadController@doLogout'));
// route to process the form
Route::post('login', array('uses' => 'DownloadController@doLogin'));
//
Route::group(array('before' => 'auth'), function(){
Route::get('admin',array('as'=>'admin','uses'=>'AdminController@index'));

});
Route::get('product',array('as'=>'product','uses'=>'ProductController@index'));
Route::get('buy/{id}/paypal',array('as' =>'buy' ,'uses'=>'PaypalController@index' ));
Route::post('buy/{id}/paypal',array('as' =>'buy' ,'uses'=>'PaypalController@redirect' ));
//Downloadlink
Route::get('download/{token}/{username}/script',array('as'=>'download','uses'=>'DownloadController@download'));
Route::get('order/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));