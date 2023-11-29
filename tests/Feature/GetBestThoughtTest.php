<?php

namespace Tests\Feature;

use App\Models\BestThought;
use App\Models\User;
use App\Modules\BestThoughts\Application\UseCases\GetBestThoughtsCommandInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetBestThoughtTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_best_thoughts()
    {
        $text = "test text";
        $guid = uniqid();
        $user = User::factory()->create();

        BestThought::factory()->create(
            [
                'text' => $text,
                'guid' => $guid,
                'userd' => $user->id
            ]
        );

        $getBestThoughtsCommand = app(GetBestThoughtsCommandInterface::class);
        $bestThoughts = $getBestThoughtsCommand->execute();

        $this->assertSame($guid, $bestThoughts->guid);
    }
}
