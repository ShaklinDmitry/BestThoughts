<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Modules\User\Application\Usecases\CreateUserTokenCommandInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTokenForUserAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_token_for_user_auth()
    {
        $user = User::factory()->create();

        $createTokenForUserAuthCommand = app(CreateUserTokenCommandInterface::class);
        $createTokenForUserAuthCommand->execute($user->id);

        $this->assertDatabaseHas("personal_access_tokens",
        [
            'tokenable_id' => $user->id
        ]);
    }
}
