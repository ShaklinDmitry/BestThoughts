<?php

namespace App\Modules\Pictures\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pictures\Application\GetImagesCommandInterface;
use App\Modules\Pictures\Application\SaveImageCommandInterface;
use App\Modules\Pictures\Domain\ImageUploadedFileInterface;
use App\Modules\Pictures\Infrastructure\Storage\ImageUploadedFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    /**
     * @param SaveImageCommandInterface $saveImageCommand
     */
    public function __construct(private SaveImageCommandInterface $saveImageCommand, private GetImagesCommandInterface $getImagesCommand)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveImage(Request $request){

        $image = $request->file('image');
        $imageUploadedFile = new ImageUploadedFile($image);

        $imageRepositoryDTO = $this->saveImageCommand->execute($imageUploadedFile, Auth::id());

        return response()->json([
            "data" => [
                "message" => "Image created",
                "image" => $imageRepositoryDTO->toArray()
            ]
        ]);
    }

    public function getImages(Request $request){
        $validator = Validator::make($request->all(), [
            'page' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => 'The given data was invalid.', 'errors' => $validator->errors()]);
        }

        $images = $this->getImagesCommand->execute(Auth::id(), $request->page);

        dd($images[0]);
    }
}
