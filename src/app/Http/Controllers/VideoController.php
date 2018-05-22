<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Storage;

class VideoController extends Controller
{
    public function getVideo($videoId)
    {
        $user = Auth::user();
        $video = $user->videos()->find($videoId);
        $file = Storage::get("/". $video->video);
        $fileType = str_after($video->video, '.');
        return response($file, 200)->header('Content-Type', $fileType);
    }
}
