@extends('master')

<!-- Index/Frontpage for the Login/Register website -->

<!-- Content of indexpage inside the body -->
@section('content')
    <div class="container" id="frontpageDiv">
        <div class="container">
            <h1 class="header center green-text">ABOUT</h1>
            <div class="row center">
                @if(session('success'))
                    <p class="header">
                        {{ session('success') }}
                    </p>
                @endif
                <p class="header col s12 light">
                    In publishing and graphic design, lorem ipsum is common placeholder text used to demonstrate the
                    graphic elements of a
                    document or visual presentation, such as web pages, typography, and graphical layout. It is a form
                    of "greeking".
                    Even though using "lorem ipsum" often arouses curiosity due to its resemblance to classical Latin,
                    it is not intended
                    to have meaning. Where text is visible in a document, people tend to focus on the textual content
                    rather than upon overall
                    presentation, so publishers use lorem ipsum when displaying a typeface or design in order to direct
                    the focus to presentation.
                    "Lorem ipsum" also approximates a typical distribution of letters in English.
                </p>
            </div>
        </div>
        <div class="row center padding-bottom-1">
            <a href="{{ route ('login') }}" class="btn-small green" id="loginButton">login</a>
            <a href="{{ route ('apply') }}" class="btn-small green" id="applyButton">apply</a>
        </div>
    </div>


@endsection