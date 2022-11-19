<?php

namespace Services\Telegram;

use Throwable;
use Illuminate\Support\Facades\Http;
use App\Exceptions\TelegramApiException;

class TelegramBotApi implements TelegramBotApiContract
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws TelegramApiException
     */
    public static function sendMessage(string $token, int $id, string $msg): bool
    {
        try {
            $response = Http::get(self::HOST . "$token/sendMessage", [
                'text' => $msg,
                'chat_id' => $id,
            ])
                ->throw();

            return $response->status();
        } catch (Throwable $e) {
            throw new TelegramApiException($e->getMessage());
        }
    }

    /** @see TelegramBotApiFake */
    public static function fake(): TelegramBotApiContract
    {
        return app()->instance(TelegramBotApiContract::class, new TelegramBotApiFake());
    }
}
