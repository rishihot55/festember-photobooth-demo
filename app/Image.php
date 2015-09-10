<?php

namespace App;

use Storage;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images';

    public static function saveImage($image_encoded, $festember_id) {
      $image_stripped = str_replace('data:image/png;base64,', '', $image_encoded);
    	$image_stripped = str_replace(' ', '+', $image_stripped);
    	$image_data = base64_decode($image_stripped);
      $image_url = $festember_id . '_'. uniqid() . '.png';
      try {
        Storage::disk('local')->put($image_url, $image_data);
        return $image_url;
      } catch (Exception $e) {
        return false;
      }
    }
}
