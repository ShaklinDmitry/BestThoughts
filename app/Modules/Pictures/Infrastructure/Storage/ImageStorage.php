<?php

namespace App\Modules\Pictures\Infrastructure\Storage;

use App\Modules\Pictures\Application\DTOs\ImageDTO;
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
     * @return ImageDTO
     */
    public function saveImage(ImageUploadedFileInterface $file, int $userId): ImageDTO
    {

        $image = $file->getUploadedFile();

        if($image) {
            $fileName   = time() . $image->getClientOriginalName();
            $path = Storage::putFileAs(
                "images/$userId", $image, $fileName
            );

            $file_name  = $image->getClientOriginalName();
            $file_type  = $image->getClientOriginalExtension();
            $filePath   = $path . $fileName;

            return new ImageDTO($file_name, $filePath, $this->fileSize($image), $file_type);
        }
    }


}
