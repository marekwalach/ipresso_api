<?php

namespace iPresso\Service;

use iPresso\Model\Attribute;
use Itav\Component\Serializer\Serializer;

/**
 * Class AttributeService
 * @package iPresso\Service
 */
class AttributeService implements ServiceInterface
{
    /**
     * @var Service
     */
    private $service;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * AttributeService constructor.
     * @param Service $service
     * @param Serializer $serializer
     */
    public function __construct(Service $service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * Add new attributes
     * @param Attribute $attribute
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Attribute $attribute)
    {
        return $this
            ->service
            ->setRequestPath('attribute')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($attribute->getAttribute())
            ->request();
    }

    /**
     * Get available attributes
     * @return bool|Response
     */
    public function get()
    {
        return $this
            ->service
            ->setRequestPath('attribute')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Add new options to attribute
     * @param Attribute $attribute
     * @return bool|Response
     */
    public function addOption(Attribute $attribute)
    {
        return $this
            ->service
            ->setRequestPath('attribute/' . $attribute->getKey() . '/option')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($attribute->getAttribute(true))
            ->request();
    }
}