<?php

namespace Tests\Feature\BestThought;

use App\Models\BestThought;
use App\Models\User;
use App\Modules\BestThoughts\Application\UseCases\GetBestThoughtsCommandInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
                'user_id' => $user->id
            ]
        );

        $getBestThoughtsCommand = app(GetBestThoughtsCommandInterface::class);
        $bestThoughts = $getBestThoughtsCommand->execute($user->id);

        $this->assertSame($guid, $bestThoughts->collection[0]->guid);
    }
}
