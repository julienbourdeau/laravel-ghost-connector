<?php

namespace Julienbourdeau\LaravelGhostConnector;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Post extends Model
{
    use Sushi;

    protected $keyType = 'string';

    public function getRows()
    {
        return app(GhostClient::class)->posts([
            'limit' => 'all',
            'include' => 'authors,tags',
        ])['posts'];
    }
}
