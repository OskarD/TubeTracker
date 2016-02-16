@extends('layouts.master')
@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Channels</div>
            <div class="panel-body">
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
                <div>
                    <a href="{{ action('ChannelController@create') }}" class="btn btn-primary">Add new channels to track</a>
                </div>

            </div>
        </div>
    </div>
@endsection