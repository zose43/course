<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;
use App\Exceptions\TelegramApiException;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws TelegramApiException
     */
    public static function sendMessage(string $token, int $id, string $msg): void
    {
        $response = Http::get(self::HOST . "$token/sendMessage", [
            'text' => $msg,
            'chat_id' => $id,
        ]);

        if (!$response->successful()) {
            throw new TelegramApiException($response->status(), $response->reason());
        }
    }
}
