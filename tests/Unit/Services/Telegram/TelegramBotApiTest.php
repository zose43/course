<?php

namespace Tests\Unit\Services\Telegram;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Services\Telegram\TelegramBotApi;
use Services\Telegram\TelegramBotApiContract;

/**
 * @coversDefaultClass TelegramBotApi
 */
class TelegramBotApiTest extends TestCase
{
    /**
     * @test
     */
    public function is_send_message_success(): void
    {
        Http::fake([
            TelegramBotApi::HOST . '*' => Http::response(['ok' => true]),
        ]);
        $result = TelegramBotApi::sendMessage('', 1, 'testing');

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function is_send_message_failure_through_fake_bot(): void
    {
        TelegramBotApi::fake()
            ->failure();

        $result = app(TelegramBotApiContract::class)::sendMessage('token_test', 1, 'testing');

        $this->assertFalse($result);
    }
}