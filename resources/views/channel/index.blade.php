@extends('layouts.master')
@section('content')
    <h1>Channels</h1>

    <div>
        @if(!count($channels))
            You are not tracking any channels.
        @else
            <ul>
            @foreach($channels as $channel)
                <li>
                    <a href="{{ action('ChannelController@show', $channel->id) }}">{{ $channel->youtube_id }}</a>
                </li>
            @endforeach
            </ul>
        @endif
    </div>

    <div>
        <a href="{{ action('ChannelController@create') }}" class="btn btn-primary">Add new channels to track</a>
    </div>
@endsection