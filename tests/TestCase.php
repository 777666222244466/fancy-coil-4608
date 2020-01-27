<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\Support\UseAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, UseAuth;

    protected function setUp() :void
    {
        parent::setUp();

        TestResponse::macro('data', function ($key) {
            return $this->original->getData()[$key];
        });
    }
}
