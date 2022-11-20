<?php

namespace Tests\Feature\Domain\Auth\Actions;

use Tests\TestCase;
use Domain\Auth\DTOs\NewUserDTO;
use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Actions\RegisterNewUserAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Auth\Contracts\RegisterNewUserContract;

/**
 * @coversDefaultClass RegisterNewUserAction
 */
class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    private array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = SignUpFormRequest::factory()->create();
    }

    /**
     * @test
     */
    public function is_success_user_created(): void
    {
        $this->assertDatabaseMissing(self::TABLE, ['email' => $this->request['email']]);

        $action = app(RegisterNewUserContract::class);
        $action(NewUserDTO::fromRequest(new SignUpFormRequest($this->request)));

        $this->assertDatabaseHas(self::TABLE, ['email' => $this->request['email']]);
    }
}