<?php

namespace App\Traits\Models;

use RuntimeException;

trait HasThumbnail
{
    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }

    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        if (self::THUMBNAIL_DIR === null) {
            throw new RuntimeException('Init in model THUMBNAIL_DIR const');
        }

        return route('thumbnail', [
            'size' => $size,
            'method' => $method,
            'dir' => self::THUMBNAIL_DIR,
            'file' => basename($this->{$this->thumbnailColumn()}),
        ]);
    }
}