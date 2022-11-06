<?php

namespace Tests\Unit\Services\Telegram;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Services\Telegram\TelegramBotApi;

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
}