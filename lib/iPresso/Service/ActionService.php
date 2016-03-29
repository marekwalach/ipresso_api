<?php

namespace iPresso\Service;

use iPresso\Model\Action;

class ActionService
{
    private $service;

    /**
     * ActionService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
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