<?php

namespace Support\Faker;

use Faker\Provider\Base;
use Support\enums\Paths;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    public function localImage(string $storageDir): string
    {
        $storage = Storage::disk('images');
        if (!$storage->exists($storageDir)) {
            $storage->makeDirectory($storageDir);
        }

        $file = $this->generator->file(
            Paths::FIXTURE_PATH . '/images' . $storageDir,
            $storage->path($storageDir),
            false
        );

        return $storageDir . '/' . $file;
    }
}
