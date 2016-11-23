<?php

namespace iPresso\Service;

use iPresso\Model\Attribute;

class AttributeService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * AttributeService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Add new attributes
     * @param Attribute $attribute
     * @return bool|mixed
     * @throws \Exception
     */
    public function add(Attribute $attribute)
    {
        return $this
            ->service
            ->setPath('attribute')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($attribute->getAttribute())
            ->request();
    }

    /**
     * Get available attributes
     * @return bool|mixed
     */
    public function get()
    {
        return $this
            ->service
            ->setPath('attribute')
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }
}