<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestThought extends Model
{
    use HasFactory;

    protected $table = 'best_thought';

    protected $fillable = ['guid', 'text'];

}
