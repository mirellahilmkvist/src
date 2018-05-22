@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('createDatapoint', ['roundId' => $roundId]) }}" method="post" enctype="multipart/form-data">
{{--            {!! Form::model($roundId, ['method' => 'POST', 'route' => ['createDatapoint', $roundId]]) !!}--}}
            @csrf
            @if($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <ul>
                <label for="directionCheckbox">DirectionDatapoint</label>
                <vr></vr>
                <input type="checkbox" id="is_direction" name="is_direction" checked="checked" value="true">
            </ul>
            <ul>
                <input type="text" name="title" placeholder="title">
            </ul>
            <ul>
                <input type="text" name="text" placeholder="text">
            </ul>
            <ul>
                <input type="text" name="point_pos_lat" placeholder="point_pos_lat">
            </ul>
            <ul>
                <input type="text" name="point_pos_long" placeholder="point_pos_long">
            </ul>
            <ul>
                <input type="file" name="image">
            </ul>
            <ul>
                <input type="text" name="image_id" placeholder="Image ID if no image">
            </ul>
            <ul>
                <input type="file" name="video">
            </ul>
            <ul>
                <input type="text" name="video_id" placeholder="Video ID if no video">
            </ul>
            <ul>
                <input type="file" name="audio">
            </ul>
            <ul>
                <input type="text" name="audio_id" placeholder="Audio ID if no image">
            </ul>
            <ul>
                <button type="submit">Save</button>
            </ul>
        </form>
    </div>
@endsection
