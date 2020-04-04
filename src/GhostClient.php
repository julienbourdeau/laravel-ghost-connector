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

    public function posts(array $requestParameters = [])
    {
        return $this->get('/posts', $requestParameters);
    }

    public function get($endpoint, array $requestParameters = [])
    {
        return Http::get($this->url($endpoint, $requestParameters))->json();
    }

    protected function url($endpoint, array $requestParameters = [])
    {
        $requestParameters += ['key' => $this->contentKey];

        $url = sprintf(
            '%s/ghost/api/v3/content/%s/?%s',
            trim($this->apiUrl, '/'),
            trim($endpoint, '/'),
            http_build_query($requestParameters)
        );

        return $url;
    }
}
