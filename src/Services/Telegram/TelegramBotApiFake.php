<?php

namespace Services\Telegram;

class TelegramBotApiFake extends TelegramBotApi
{
    protected static bool $result = true;

    public static function sendMessage(string $token, int $id, string $msg): bool
    {
        return self::$result;
    }

    public function success(): static
    {
        self::$result = true;

        return $this;
    }

    public function failure(): static
    {
        self::$result = false;

        return $this;
    }
}