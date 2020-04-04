<?php

namespace Julienbourdeau\LaravelGhostConnector;

use Illuminate\Support\Facades\Http;

class GhostClient
{
    private $apiUrl;
    private $contentKey;

    public function __construct($apiUrl, $contentKey)
    {
        $this->apiUrl = $apiUrl;
        $this->contentKey = $contentKey;
    }

    public function posts()
    {
        return $this->get('/posts');
    }

    public function get($endpoint)
    {
        $url = sprintf(
            '%s/ghost/api/v3/content/%s/?key=%s',
            trim($this->apiUrl, '/'),
            trim($endpoint, '/'),
            urlencode(trim($this->contentKey, '/'))
        );

        return Http::get($url)->json();
    }
}
