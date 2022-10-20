<?php

namespace App\Logging\Telegram;

use Exception;
use Monolog\Logger;
use App\Exceptions\TelegramApiException;
use App\Services\Telegram\TelegramBotApi;
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
        try {
            TelegramBotApi::sendMessage($this->token, $this->chatId, $record['formatted']);
        } catch (TelegramApiException|Exception $e) {
            logger()?->error($e->getMessage() . ', in ' . __METHOD__);
        }
    }
}
