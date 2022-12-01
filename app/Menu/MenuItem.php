<?php

namespace App\Menu;

use Support\Traits\DTOs\Makeable;

class MenuItem extends Menu
{
    use Makeable;

    public function __construct(private readonly string $label, private readonly string $link) {}

    public function getLink(): string
    {
        return $this->link;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function isActive(): bool
    {
        $path = parse_url($this->link, PHP_URL_PATH) ?? '/';

        if ($path === '/') {
            return request()?->path() === $path;
        }

        return request()?->fullUrlIs($this->link . '*');
    }
}