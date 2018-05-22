<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * This is so that unauthenticated users cannot access. If you hit this
     * this without authentication, you will not continue.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function getUserName()
    {
        $user = Auth::user();
        $username = $user->name;
        return response($username, 200);
    }
}
