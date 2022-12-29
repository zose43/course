<?php

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartIdentityStorageContract;

class FakeIdentityStorage implements CartIdentityStorageContract
{
    public const ID = 'fake_storage_id';

    public function get(): string
    {
        return self::ID;
    }
}