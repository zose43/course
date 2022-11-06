<?php

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    public const MESSAGE_KEY = 'course_flash_msg';
    public const MESSAGE_CLASS = 'course_flash_class';

    public function __construct(protected Session $session) {}

    private function flash(string $message, string $name): void
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::MESSAGE_CLASS, config("flash.$name", ''));
    }

    public function info(string $message): void
    {
        $this->flash($message, 'info');
    }

    public function alert(string $message): void
    {
        $this->flash($message, 'alert');
    }

    public function message(): ?FlashMessage
    {
        if ($message = $this->session->get(self::MESSAGE_KEY)) {
            return new FlashMessage($message, $this->session->get(self::MESSAGE_CLASS, ''));
        }

        return null;
    }
}