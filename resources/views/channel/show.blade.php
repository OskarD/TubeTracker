@extends('layouts.master')
@section('content')
    <h1>Channel: {{ $channel->youtube_id }}</h1>


    <form action="{{ action('ChannelController@destroy', $channel->id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('ChannelController@index') }}">Back</a>
            <a class="btn btn-default" href="http://youtube.com/channel/{{ $channel->youtube_id }}">YouTube Webpage</a>
            <button class="btn btn-danger" type="submit">Stop Tracking</button>
        </div>
    </form>

@endsection