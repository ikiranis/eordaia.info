<?php
/**
 *
 * File: VideoService.php
 *
 * Created by Yiannis Kiranis <rocean74@gmail.com>
 * http://www.apps4net.eu
 *
 * Date: 12/5/20
 * Time: 11:55 μ.μ.
 *
 * Methods for video service
 *
 */

namespace App\Services;

class VideoService
{
    /**
     * Επιστρέφει το id ενός youtube video από το url του
     * Source from http://code.runnable.com/VUpjz28i-V4jETgo/get-youtube-video-id-from-url-for-php
     * TODO έχει πρόβλημα όταν το λινκ του youtube έχει τον χρονικό σημείο που πρέπει να παίξει
     *
     * @param string $videoUrl
     * @return bool|false|mixed|string
     */
    static function getYoutubeID(string $videoUrl){
        $video_id = false;
        $url = parse_url($videoUrl);

        if (strcasecmp($url['host'], 'youtu.be') === 0)
        {
            $video_id = substr($url['path'], 1);
        }
        elseif (strcasecmp($url['host'], 'www.youtube.com') === 0)
        {
            if (isset($url['query']))
            {
                parse_str($url['query'], $url['query']);
                if (isset($url['query']['v']))
                {
                    $video_id = $url['query']['v'];
                }
            }
            if ($video_id == false)
            {
                $url['path'] = explode('/', substr($url['path'], 1));
                if (in_array($url['path'][0], array('e', 'embed', 'v')))
                {
                    $video_id = $url['path'][1];
                }
            }
        }

        return $video_id;
    }
}
