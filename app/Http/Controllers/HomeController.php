<?php

namespace TubeTracker\Http\Controllers;

use TubeTracker\Http\Requests;
use Illuminate\Http\Request;
use TubeTracker\YouTube\Video;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \Google_Client();
        $client->setDeveloperKey(getenv('GOOGLE_API_KEY'));

        // Define an object that will be used to make all API requests.
        $youtube = new \Google_Service_YouTube($client);

        $videoIds = "";
        $videos = [];

        foreach(Auth::user()->channels as $channel)
        {
            // Call the search.list method to retrieve results matching the specified
            // query term.
            $searchResponse = $youtube->search->listSearch('id', array(
                'channelId' => $channel->youtube_id
            ));

            // Add each result to the appropriate list, and then display the lists of
            // matching videos, channels, and playlists.
            foreach ($searchResponse['items'] as $searchResult) {
                if ($searchResult['id']['kind'] == 'youtube#video') {
                    $videoIds .= $searchResult['id']['videoId'] . ",";
                }
            }
        }

        $searchResponse = $youtube->videos->listVideos('snippet,statistics', array(
            'id' => $videoIds
        ));

        foreach($searchResponse['items'] as $searchResult)
        {
            $videos[] = new Video([
                'title' => $searchResult['snippet']['title'],
                'videoId' => $searchResult['id'],
                'channelId' => $searchResult['snippet']['channelId'],
                'channelTitle' => $searchResult['snippet']['channelTitle'],
                'description' => $searchResult['snippet']['description'],
                'publishedAt' => $searchResult['snippet']['publishedAt'],
                'thumbnail' => $searchResult['snippet']['modelData']['thumbnails']['default']['url'],
                'thumbnailWidth' => $searchResult['snippet']['modelData']['thumbnails']['default']['width'],
                'thumbnailHeight' => $searchResult['snippet']['modelData']['thumbnails']['default']['height'],
                'viewCount' => $searchResult['statistics']['viewCount'],
                'likeCount' => $searchResult['statistics']['likeCount'],
                'dislikeCount' => $searchResult['statistics']['dislikeCount'],
                'favoriteCount' => $searchResult['statistics']['favoriteCount'],
                'commentCount' => $searchResult['statistics']['commentCount'],
                'rawData' => $searchResult,
            ]);
        }

         //$videos = usort($videos, [Video::class, "cmp"]);


        return view('home', compact('videos'));
    }
}
