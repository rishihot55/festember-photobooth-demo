<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use \App\Student;
use \App\Image;

Route::get('/', function () {
    return view('home');
});

Route::get('/students/{card}', function($card) {
	$student = Student::where('card', $card)->first();
	return response()->json($student);
});

Route::post('images', function() {
	$image_encoded = Request::input('base64image');
	$image_stripped = str_replace('data:image/png;base64,', '', $image_encoded);
	$image_stripped = str_replace(' ', '+', $image_stripped);
	$image_data = base64_decode($image_stripped);
	$image_url = uniqid() . '.png';
	Storage::disk('local')->put($image_url, $image_data);

	$image = new Image;
	$image->festember_id = Request::input('festember_id');
	$image->image_url = $image_url;

	$image->save();

	return response()->json(["image_saved" => true]);
});

Route::get('images', function() {
	$images = Image::all();
	return response()->json($images);
});