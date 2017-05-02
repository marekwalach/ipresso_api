<?php

namespace iPresso\Service;

use iPresso\Model\Action;
use Itav\Component\Serializer\Serializer;

/**
 * Class ActionService
 * @package iPresso\Service
 */
class ActionService implements ServiceInterface
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
     * ActionService constructor.
     * @param Service $service
     * @param Serializer $serializer
     */
    public function __construct(Service $service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * Add new actions
     * @param Action $action
     * @return bool|Response
     * @throws \Exception
     */
    public function addAction(Action $action)
    {
        return $this
            ->service
            ->setRequestPath('action')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($action->getAction())
            ->request();
    }

    /**
     * Get available actions
     * @return bool|Response
     */
    public function get()
    {
        return $this
            ->service
            ->setRequestPath('action')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }
}