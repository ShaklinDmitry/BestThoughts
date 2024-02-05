<?php

namespace App\Modules\Pictures\Infrastructure\Model;

use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ImageEloquent extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = ['guid', 'name', 'path', 'size', 'type', 'user_id'];

    protected static function newFactory()
    {
        return ImageFactory::new();
    }

}
