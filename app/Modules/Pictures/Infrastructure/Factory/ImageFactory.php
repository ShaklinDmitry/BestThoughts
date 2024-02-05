<?php

namespace Database\Factories;

use App\Modules\Pictures\Infrastructure\Eloquent\ImageEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Pictures\Infrastructure\Eloquent\ImageEloquent>
 */
class ImageFactory extends Factory
{
    protected $model = ImageEloquent::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
