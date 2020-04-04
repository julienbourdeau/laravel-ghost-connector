<?php

namespace Julienbourdeau\LaravelGhostConnector;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Post extends Model
{
    use Sushi;

    public function getRows()
    {
        return app(GhostClient::class)->posts([
            'limit' => 'all'
        ])['posts'];
    }
}
