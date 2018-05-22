@extends('master')

@section('content')

    <div class="container" id="loginDiv">
        <img src="app_images/storyicon.png" id="storyIcon">
        <div class="row">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-field col s12">
                    <i class="material-icons prefix green-text">account_circle</i>
                    <input placeholder="e-mail" type="text" name="email" value="{{ old('email') }}">
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix green-text">vpn_key</i>
                    <input placeholder="password" type="password" name="password" class="validate">
                </div>
                <div class="container">
                    <button class="btn-small green" type="submit" id="btnSignIn"><span>sign in</span></button>
                </div>
                <div class="col s12">
                    <ul id="loginHelp">
                        <li>Forgot your password? Please contact us<a href="#"> here!</a></li>
                    </ul>
                </div>
            </form>

        </div>
    </div>
@endsection