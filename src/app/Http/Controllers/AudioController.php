<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Storage;

class AudioController extends Controller
{
    public function getAudio($audioId)
    {
        $user = Auth::user();
        $audio = $user->audio()->find($audioId);
        $file = Storage::get("/". $audio->audio);
        $fileType = str_after($audio->audio, '.');
        return response($file, 200)->header('Content-Type', $fileType);
    }
}
