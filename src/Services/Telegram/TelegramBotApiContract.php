<?php

namespace Services\Telegram;

interface TelegramBotApiContract
{
    public static function sendMessage(string $token, int $id, string $msg): bool;
}