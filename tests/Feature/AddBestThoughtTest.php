<?php

namespace Tests\Feature;

use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommand;
use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommandInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddBestThoughtTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_best_thought()
    {
        $text = 'test text';

        $addBestThoughtCommand = app(AddBestThoughtCommandInterface::class);
        $addBestThoughtCommand->execute($text);

        $this->assertDatabaseHas('best_thought', [
            'text' => $text,
        ]);
    }
}
