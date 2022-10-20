<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, int $id, string $msg): void
    {
        Http::get(self::HOST . "$token/sendMessage", [
            'text' => $msg,
            'chat_id' => $id,
        ]);
    }
}
