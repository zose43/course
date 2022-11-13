<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    public function __invoke(string $dir, string $method, string $size, string $file): BinaryFileResponse
    {
        abort_if(!in_array($size, config('thumbnail.allowed_sizes'), true),
            403,
            'Size not allowed');

        $storage = Storage::disk('images');

        $realPath = "$dir/$file";
        $newPath = "$dir/$method/$size";
        $resultPath = "$newPath/$file";

        if (!$storage->exists($newPath)) {
            $storage->makeDirectory($newPath);
        }
        if (!$storage->exists($resultPath)) {
            $image = Image::make($storage->path($realPath));
            [$w, $h] = explode('x', $size);

            $image->{$method}($w, $h);
            $image->save($storage->path($resultPath));
        }

        return response()->file($storage->path($resultPath));
    }
}