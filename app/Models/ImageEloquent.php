<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageEloquent extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = ['guid', 'name', 'path', 'size', 'type', 'user_id'];

}
