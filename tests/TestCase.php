<?php

namespace Tests;

use Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        /**
         * throw exception, if request is not fake
         * if in test required real request --> use Http::allowStrayRequests()
         */
        Http::preventStrayRequests();
        Notification::fake();
    }
}
