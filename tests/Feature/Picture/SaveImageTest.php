<?php

namespace Tests\Feature\Picture;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SaveImageTest extends TestCase
{

    public function test_save_image()
    {
//        $name = 'test';
//        $path = storage_path('images/');
//        $size = '300';
//        $type = 'jpeg';

        $user = User::factory()->create();

        Storage::fake('public');
        $file = UploadedFile::fake()->image('test.jpg');

        $saveImageCommand = app(SaveImageCommandInterface::class);
        $saveImageCommand->execute($file, $file->name, $file->path(), $file->size(), $file->getType(), $user->id);

        $this->assertDatabaseHas('images',
        [
            'name' => $file->name,
            'path' => $file->path(),
            'size' =>  $file->size(),
            'type' => $file->getType(),
            'user_id' => $user->id
        ]);

        Storage::disk('local')->assertExists("/images/" . $file->name);
    }
}
