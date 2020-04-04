<?php

namespace Julienbourdeau\LaravelGhostConnector\Tests;

use Julienbourdeau\LaravelGhostConnector\GhostClient;
use Julienbourdeau\LaravelGhostConnector\LaravelGhostConnectorServiceProvider;
use Julienbourdeau\LaravelGhostConnector\Post;
use Mockery;
use Orchestra\Testbench\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ModelTest extends TestCase
{
    /** @test */
    public function postsAreRetrievedAsModelCollection()
    {
        $this->instance(GhostClient::class, Mockery::mock(GhostClient::class, function ($mock) {
            $mock->shouldReceive('posts')
                ->once()
                ->with([
                    'limit' => 'all',
                    'include' => 'authors,tags',
                ])
                ->andReturn(
                    $this->posts()
                );
        }));

        $this->assertEquals(7, Post::count());
        $this->assertEquals('97f42901-6b26-4a61-9ec6-96852d05e0f3', Post::first()->uuid);
        $this->assertEquals([
            'Welcome to Ghost',
            'Writing posts with Ghost ✍️',
            'Publishing options',
            'Managing admin settings',
            'Organising your content',
            'Apps & integrations',
            'Creating a custom theme',
        ], Post::all()->map(function ($post) {
            return $post->title;
        })->toArray());
    }

    /** @test */
    public function modelsHaveCorrectIds()
    {
        $this->instance(GhostClient::class, Mockery::mock(GhostClient::class, function ($mock) {
            $mock->shouldReceive('posts')->andReturn($this->posts());
        }));

        $this->assertEquals('5e80568dc50444aef65bea46', Post::first()->id);
        $this->assertEquals('d28c25c8-59b6-4a9f-ae80-8c0db3f82255', Post::find('5e80568dc50444aef65bea3e')->uuid);
    }

    protected function getPackageProviders($app)
    {
        return [LaravelGhostConnectorServiceProvider::class];
    }

    private function posts()
    {
        return json_decode(file_get_contents(__DIR__.'/fixtures/posts.json'), true);
    }
}
