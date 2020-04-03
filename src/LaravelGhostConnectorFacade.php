<?php

namespace Julienbourdeau\LaravelGhostConnector;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Julienbourdeau\LaravelGhostConnector\Skeleton\SkeletonClass
 */
class LaravelGhostConnectorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-ghost-connector';
    }
}
