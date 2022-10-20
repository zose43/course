<?php

namespace App\Exceptions;

use Exception;

class TelegramApiException extends Exception
{
    public function __construct(private readonly int $status, private readonly string $response)
    {
        parent::__construct();
        $this->message = $this->getText();
    }

    public function getText(): string
    {
        return "Telegram Api went unsuccessful response;\nstatus: $this->status, text: $this->response";
    }
}
