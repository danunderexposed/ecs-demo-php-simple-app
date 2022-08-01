<?php

namespace App\Utilities;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Base64ImageToS3 {

    public static function uploadToS3(string $base64Image, string $prefix = '', string $directory = 'at2', array $dimensions = [])
    {
        $filename = uniqid($prefix) . '.png';

        // resize image if dimensions set
        if (count($dimensions) > 0){
            $img = Image::make($base64Image);
            $img->resize($dimensions[0], $dimensions[1]);
            $base64Image = (string) $img->stream('data-uri');
        }

        list($baseType, $image) = explode(';', $base64Image);
        list(, $image) = explode(',', $image);
        $image = base64_decode($image);

        $path = $directory . '/' . $filename;
        $file = Storage::disk('s3')->put($path, $image, 'public'); // old : $file

        // get public url
        $s3 = Storage::disk('s3')->getAdapter()->getClient();
        return $s3->getObjectUrl( config('filesystems.disks.s3.bucket'), $path );

    }
}
