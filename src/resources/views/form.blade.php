@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('createRound') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <ul>
                <input type="text" name="title" placeholder="Title">
            </ul>
            <ul>
                <input type="text" name="author" placeholder="Author">
            </ul>
            <ul>
                <input type="text" name="genre" placeholder="Genre">
            </ul>
            <ul>
                <input type="text" name="description" placeholder="Description">
            </ul>
            <ul>
                <input type="text" name="city" placeholder="City">
            </ul>
            <ul>
                <input type="text" name="start_pos_lat" placeholder="Start position lattitude">
            </ul>
            <ul>
                <input type="text" name="start_pos_long" placeholder="Start position longitude">
            </ul>
            <ul>
                <input type="text" name="language" placeholder="Language">
            </ul>
            <ul>
                <input type="text" name="image_id" placeholder="Image ID if no Image">
            </ul>
            <ul>
                <input type="file" name="image">
            </ul>
            <ul>
                <button type="submit">Save</button>
            </ul>
        </form>
    </div>
@endsection
