<?php

namespace App\Modules\Pictures\Infrastructure\Storage;

use App\Modules\Pictures\Application\DTOs\GetImageStorageDTO;
use App\Modules\Pictures\Application\DTOs\ImageStorageDTO;
use App\Modules\Pictures\Domain\ImageStorageInterface;
use App\Modules\Pictures\Domain\ImageUploadedFileInterface;
use App\Modules\Pictures\Infrastructure\Helpers\FileSize;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageStorage implements ImageStorageInterface
{
    use FileSize;

    /**
     * @param ImageUploadedFileInterface $file
     * @param int $userId
     * @return ImageStorageDTO
     */
    public function saveImage(ImageUploadedFileInterface $file, int $userId): ImageStorageDTO
    {

        $image = $file->getUploadedFile();

        if($image) {
            $fileName   = time() . $image->getClientOriginalName();
            $filePath = Storage::putFileAs(
                "public/images", $image, $fileName
            );

            $file_name  = $image->getClientOriginalName();
            $file_type  = $image->getClientOriginalExtension();

            return new ImageStorageDTO($file_name, $filePath, $this->fileSize($image), $file_type);
        }
    }


    /**
     * @param string $path
     * @return mixed
     */
    public function getImage(string $path)
    {
        $imageContent = Storage::get( $path);

        return $imageContent;
    }


}
