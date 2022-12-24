<?php

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartIdentityStorageContract;

class SessionStorageIdentity implements CartIdentityStorageContract
{
    public function get(): string
    {
        return session()->getId();
    }
}