@extends('layouts.master')

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
                You are logged in!
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Video Title</th>
                        <th>Channel Title</th>
                        <th>Views</th>
                        <th>Likes/Dislikes</th>
                        <th>Favorites</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->channelTitle }}</td>
                            <td>{{ $video->likeCount }}/{{ $video->dislikeCount }}</td>
                            <td>{{ $video->viewCount }}</td>
                            <td>{{ $video->favoriteCount }}</td>
                            <td>{{ $video->commentCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
