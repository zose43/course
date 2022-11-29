<?php

namespace Support\enums;

enum Paths: string
{
    case ProductImages = '/products';
    case BrandImages = '/brands';

    public const FIXTURE_PATH = 'tests/Fixtures/';
    public const STORAGE_IMAGES = '/storage/images';
}
