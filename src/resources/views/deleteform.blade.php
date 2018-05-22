@extends('layouts.app')

@section('content')
    // Not tested
    <div class="container">
            @csrf
            @if($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <form action="{{ url()->current() }}/create" method="post">
                {{ csrf_field() }}
                {{ method_field('Post') }}
        </form>
    </div>
@endsection
