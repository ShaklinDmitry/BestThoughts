<?php

namespace App\Modules\Pictures\Infrastructure\Helpers;

use Illuminate\Http\UploadedFile;

trait FileSize
{
    /**
     * @param UploadedFile $file
     * @param $precision
     * @return false|int|string
     */
    public function fileSize(UploadedFile $file, $precision = 2)
    {
        $size = $file->getSize();

        if ( $size > 0 ) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}
