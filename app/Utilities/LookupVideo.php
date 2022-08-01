<?php

namespace App\Utilities;


class LookupVideo {

    public static function lookup(string $url)
    {
        $imageUrl = '';

        if (strpos($url, 'youtube') !== false || strpos($url, 'youtu.be') !== false ) {
           preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
           if (count($matches) > 0) {
                $ytId = $matches[0];
                $imageUrl = "http://img.youtube.com/vi/" . $ytId . "/0.jpg";
           }
        } elseif (strpos($url, 'vimeo') !== false ) {
            preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $url, $matches);
            if (count($matches) > 0) {
                $vimeoId = end($matches);
                $vimeoApi = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/$vimeoId.php" ) );
                //dd($vimeoApi);
                $imageUrl = $vimeoApi[0]['thumbnail_large'];
           }
        }

        return $imageUrl;

    }
}
