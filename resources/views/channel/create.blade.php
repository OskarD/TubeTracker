@extends('layouts.master')
@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Track A New Channel</div>
            <div class="panel-body">
                <div id="searchArea">
                    <yt-channel-search></yt-channel-search>
                </div>
            </div>
        </div>
    </div>

    <template id="yt-channel-search-template">
        @include('partials.errors')
        <h2>Search</h2>
        <div>
            <input type="text" class="form-control" v-model="searchQuery" name="search-query" @keyup.enter="search">
            <button type="button" class="btn btn-default" @click="search()">Search</button>
        </div>
        <div v-show="searchResult">
            <form action="{{ action('ChannelController@store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="channel_id" value="@{{ searchResult }}">
                <h3>User found!</h3>
                <div class="btn-group">
                <a target="_blank" class="btn btn-primary" href="http://youtube.com/channel/@{{ searchResult }}">Preview Channel</a>
                <button type="submit" class="btn btn-success">Track</button>
                </div>
            </form>
        </div>
    </template>
@endsection

@section('scripts')
    <script>
        var YtChannelSearch = Vue.component('yt-channel-search', {

            template: '#yt-channel-search-template',

            data: function() {
                return {
                    searchResult: null,
                    searchQuery: null
                }
            },

            methods: {
                search: function() {
                    var cont = this;

                    if(!this.searchQuery || this.searchQuery.length <= 3)
                        return;

                    this.searchResult = [];

                    $.get(
                        "https://www.googleapis.com/youtube/v3/channels", {
                            part: 'contentDetails',
                            forUsername: this.searchQuery,
                            key: "{{ getenv('GOOGLE_API_KEY') }}"
                        },
                        function(data) {
                            $(data.items).each(function(i, item) {
                                //console.log(item);
                                cont.searchResult = item.id;
                            })
                        }
                    );
                }
            }
        });

        new Vue({
            el: searchArea,
        });
    </script>
@endsection