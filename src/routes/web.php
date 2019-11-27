<?php

Route::get('/photogallery', function(){
	echo 'Hello from the photogallery package!';
});
Route::group(['namespace' => 'Neologicx\Photogallery\Http\Controllers'], function () {
    Route::resources([
		'category' => 'CategoryController',
		'image' => 'ImageController'
	]);
	Route::get('/category/destroy/{category}','CategoryController@destroy');
	Route::get('/image/destroy/{image}','ImageController@destroy');
	Route::get('/allimages/{id}', 'CategoryController@showallimages');
});
