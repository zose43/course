<?php

namespace Support\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeFormatter
{
    public function __invoke($logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                "[%datetime%]\nКанал: %channel%\nУровень: %level_name%\nСообщение: %message%\nКонтекст: %context%",
                'Y-m-d, H:i:s'
            ));
        }
    }
}
