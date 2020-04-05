<?php

namespace Julienbourdeau\LaravelGhostConnector;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Post extends Model
{
    use Sushi;

    protected $keyType = 'string';

    protected $casts = [
        'featured' => 'boolean',
        'send_email_when_published' => 'boolean',
        'reading_time' => 'int',
        'tags' => 'array',
        'primary_tag' => 'array',
        'authors' => 'array',
        'primary_author' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function getRows()
    {
        $rows = app(GhostClient::class)->posts([
            'limit' => 'all',
            'include' => 'authors,tags',
        ])['posts'];

        foreach ($rows as &$row) {
            foreach ($this->casts as $attribute => $type) {
                if ($type === 'array') {
                    $row[$attribute] = json_encode($row[$attribute]);
                }
            }
        }

        return $rows;
    }
}
