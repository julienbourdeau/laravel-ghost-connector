<?php

namespace Julienbourdeau\LaravelGhostConnector\Tests;

use Orchestra\Testbench\TestCase;
use Julienbourdeau\LaravelGhostConnector\LaravelGhostConnectorServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelGhostConnectorServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
