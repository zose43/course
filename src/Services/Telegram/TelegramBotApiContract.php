<?php

namespace Services\Telegram;

/**
 * @method TelegramBotApiFake failure
 * @method TelegramBotApiFake success
 */
interface TelegramBotApiContract
{
    public static function sendMessage(string $token, int $id, string $msg): bool;
}