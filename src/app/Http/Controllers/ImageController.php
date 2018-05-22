<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Storage;

class ImageController extends Controller
{
    public function getImage($imageId)
    {
        $user = Auth::user();
        $image = $user->images()->find($imageId);
        $file = Storage::get("/". $image->image);
        $fileType = str_after($image->image, '.');
        return response($file, 200)->header('Content-Type', $fileType);
    }
}
