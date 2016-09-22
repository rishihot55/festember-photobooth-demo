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

Route::get('/students', function() {
  $student = Student::all();
  return response()->json($student);
});

Route::get('/students/{card}', function($card) {
	$student = Student::where('card', $card)->first();
	return response()->json($student);
});

Route::post('images', function() {
	$image_encoded = Request::input('base64image');

	$image = new Image;
  $image->image_url = Image::saveImage($image_encoded);

  if ($image->image_url != false) {
    $image->save();
    return response()->json(["image_saved" => true]);
  } else {
    return response()->json(["image_saved" => false]);
  }
});

Route::get('images', function() {
	$images = Image::all();
	return response()->json($images);
});

Route::get('images/view', function() {
  return view('image_viewer');
});
Route::get('images/today', function() {
  $images = Image::where('created_at','>=', date("Y-m-d"))->get();
  return response()->json($images);
});

Route::get('images/festember_id/{id}', function($id) {
  $images = Image::where('festember_id', $id)->get();
  return response()->json($images);
});

Route::get('images/{name}/download', function($name) {
  $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
  return Response::download($storagePath. $name, $name);
});
