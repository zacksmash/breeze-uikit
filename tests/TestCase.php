<?php

namespace Zacksmash\BreezeUIkit\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BreezeUIKitServiceProvider::class,
        ];
    }
}
