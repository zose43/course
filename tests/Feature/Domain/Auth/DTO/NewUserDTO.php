<?php

namespace Tests\Feature\Domain\Auth\DTO;

use Tests\TestCase;
use Domain\Auth\DTOs\NewUserDTO as DTO;
use App\Http\Requests\SignUpFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @coversDefaultClass DTO
 */
class NewUserDTO extends TestCase
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
     * @covers \Domain\Auth\DTOs\NewUserDTO::fromRequest
     */
    public function is_instance_created_from_request(): void
    {
        $dto = DTO::fromRequest(new SignUpFormRequest($this->request));

        $this->assertInstanceOf(DTO::class, $dto);
    }

    /**
     * @test
     * @covers \Domain\Auth\DTOs\NewUserDTO::make
     */
    public function is_instance_created_from_make_with_arguments_success(): void
    {
        $dto = DTO::make(...collect($this->request)->only([
            'email',
            'name',
            'password',
        ]));

        $this->assertInstanceOf(DTO::class, $dto);
    }

    public function dtoProperties(): array
    {
        return [
            ['email', 'test@ya.ru'],
            ['password', '123456789'],
            ['name', 'Kirill'],
        ];
    }

    /**
     * @test
     * @covers       \Domain\Auth\DTOs\NewUserDTO::fromRequest
     * @dataProvider dtoProperties
     */
    public function is_properties_dto_equal_arguments_from_request(string $prop, string $value): void
    {
        $this->request[$prop] = $value;
        $dto = DTO::fromRequest(new SignUpFormRequest($this->request));

        $this->assertEquals($this->request[$prop], $dto->{$prop});
    }
}