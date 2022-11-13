<?php

namespace Support\Faker;

use Exception;
use Faker\Provider\Base;
use Illuminate\Support\Facades\File;

class FakerImageProvider extends Base
{
    public function localImage(string $source, string $dir, string $relative): ?string
    {
        if (!File::exists($dir)) {
            File::makeDirectory($dir, recursive: true);
        }

        try {
            /**
             * instead may be use $this->generator->file(), take 1 file and filename
             */
            $images = collect(File::files($source));
            $image = $images->random();
            File::copy("$source/" . $image->getFilename(), "$dir/" . $image->getFileName());
        } catch (Exception $e) {
            logger()?->channel('telegram')->error($e->getMessage(), [
                'file' => $e->getFile(),
                'source' => $source,
                'dir' => $dir,
            ]);

            return null;
        }

        return "/storage$relative" . $image->getFilename();
    }
}
