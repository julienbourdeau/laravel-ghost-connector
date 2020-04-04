<?php

namespace Julienbourdeau\LaravelGhostConnector\Tests;

use Illuminate\Support\Facades\Http;
use Julienbourdeau\LaravelGhostConnector\GhostClient;
use Julienbourdeau\LaravelGhostConnector\LaravelGhostConnectorServiceProvider;
use Orchestra\Testbench\TestCase;

/**
 * @internal
 * @coversNothing
 */
class GhostClientTest extends TestCase
{
    /** @test */
    public function ghostClientUsesCorrectConfigFromEnv()
    {
        $this->assertEquals(config('services.ghost.api_url'), 'https://tests.ghost.io');
        $this->assertEquals(config('services.ghost.content_key'), 'qwe rty');
    }

    /** @test */
    public function generateCorrectUrls()
    {
        Http::fake();
        $client = app(GhostClient::class);

        collect([
            '/posts' => 'https://tests.ghost.io/ghost/api/v3/content/posts/?key=qwe+rty',
            'tags///' => 'https://tests.ghost.io/ghost/api/v3/content/tags/?key=qwe+rty',
            'pages' => 'https://tests.ghost.io/ghost/api/v3/content/pages/?key=qwe+rty',
        ])->each(function ($url, $endpoint) use ($client) {
            $client->get($endpoint);

            Http::assertSent(function ($request) use ($url) {
                return $request->url() == $url;
            });
        });
    }

    /** @test */
    public function useCorrectEndpoints()
    {
        Http::fake();
        $client = app(GhostClient::class);

        collect([
            'posts' => 'https://tests.ghost.io/ghost/api/v3/content/posts/?key=qwe+rty',
        ])->each(function ($url, $methodName) use ($client) {
            $client->{$methodName}();

            Http::assertSent(function ($request) use ($url) {
                return $request->url() == $url;
            });
        });
    }

    protected function getPackageProviders($app)
    {
        return [LaravelGhostConnectorServiceProvider::class];
    }
}
