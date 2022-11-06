<?php

namespace Support\Logging\Telegram;

use Monolog\Logger;
use Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chatId;
    protected string $token;

    public function __construct(array $config)
    {
        parent::__construct(Logger::toMonologLevel($config['level']));
        $this->chatId = $config['chat_id'];
        $this->token = $config['token'];
    }

    protected function write(array $record): void
    {
        TelegramBotApi::sendMessage($this->token, $this->chatId, $record['formatted']);
    }
}
