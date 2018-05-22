<?php

namespace App\Http\Controllers;

use App\Mail\ApplyMail;
use Auth;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function home()
    {
        return view('frontpage');
    }

    public function apply()
    {
        return view('applypage');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/start');
        } else {
            return view('loginpage');
        }
    }

    public function mail(Request $request)
    {
        $email = [
            'company_name'   => $request->company_name,
            'company_mail'   => $request->company_mail,
            'company_number' => $request->company_number,
            'message'        => $request->message
        ];
        \Mail::to($request->company_mail)->send(new ApplyMail($email));
        return redirect('/')->withSuccess('Thank you for your application ' . $request->company_name . '!');
    }
}