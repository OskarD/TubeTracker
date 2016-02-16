<?php

namespace TubeTracker\YouTube;

use Carbon\Carbon;
use TubeTracker\User;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'videoId',
        'channelId',
        'channelTitle',
        'description',
        'publishedAt',
        'thumbnail',
        'thumbnailWidth',
        'thumbnailHeight',
        'viewCount',
        'likeCount',
        'dislikeCount',
        'favoriteCount',
        'commentCount',
        'rawData',
    ];

    /**
     * Compares two objects of the same type for sorting
     *
     * @param $a The object to compare with
     * @param $b The object to compare to
     * @return bool <code>true</code> if greater than, <code>false</code> if less than
     */
    public static function cmp($a, $b)
    {
        $format = "Y-M-d*H:i:u*+";

        return  Carbon::createFromFormat($format, $a->publishedAt)
                ->gt(
                Carbon::createFromFormat($format, $b->publishedAt));
    }
}
