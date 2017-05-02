<?php

namespace iPresso\Service;

use Itav\Component\Serializer\Serializer;

/**
 * Interface ServiceInterface
 * @package iPresso\Service
 */
interface ServiceInterface
{
    /**
     * ServiceInterface constructor.
     * @param Service $service
     * @param Serializer $serializer
     */
    public function __construct(Service $service, Serializer $serializer);
}