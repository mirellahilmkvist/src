@extends('master')

@section('content')

    <div class="container" id="applyDiv">
        <form action="{{ route('sendMail') }}">
            @csrf
            @if($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <h4 class="header center green-text">APPLY FOR MEMBERSHIP</h4>
            <div class="row center">
                <p class="light">
                    By submitting your company details you can get access to StoryTourist and create your own
                    customized stories for your audience to enjoy around the world!
                </p>
                <div class="input-field col s12">
                    <i class="material-icons prefix green-text">business</i>
                    <input name="company_name" placeholder="Company Name" type="text">
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix green-text">mail outline</i>
                    <input name="company_mail" placeholder="Company e-mail" type="text">
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix green-text">phone</i>
                    <input name="company_number" placeholder="Company phone-number" type="text">
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix green-text">mode_edit</i>
                    <input name="message" type="text" placeholder="Please write a message">
                </div>
            </div>
            <div class="row center padding-bottom-1">
                <button type="submit" class="btn-small green" id="sendButton">Submit details</button>
            </div>
        </form>
    </div>

@endsection