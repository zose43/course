<?php

namespace App\Breadcrumbs;

use Support\Traits\DTOs\Makeable;

class BreadCrumbItem extends BreadCrumb
{
    use Makeable;

    public function __construct(private readonly string $label, private readonly string $link) {}

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}