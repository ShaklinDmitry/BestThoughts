<?php

namespace App\Modules\Pictures\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pictures\Application\SaveImageCommandInterface;
use App\Modules\Pictures\Domain\ImageUploadedFileInterface;
use App\Modules\Pictures\Infrastructure\Storage\ImageUploadedFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    /**
     * @param SaveImageCommandInterface $saveImageCommand
     */
    public function __construct(private SaveImageCommandInterface $saveImageCommand)
    {
    }

    /**
     * @param Request $request
     * @return void
     */
    public function saveImage(Request $request){

        $image = $request->file('image');
        $imageUploadedFile = new ImageUploadedFile($image);

        $this->saveImageCommand->execute($imageUploadedFile, Auth::id());

    }
}
