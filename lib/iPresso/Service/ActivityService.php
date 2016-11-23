<?php

namespace iPresso\Service;

use iPresso\Model\Activity;

class ActivityService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * ActivityService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Add new activity
     * @param Activity $activity
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Activity $activity)
    {
        return $this
            ->service
            ->setPath('activity')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($activity->getActivity())
            ->request();
    }

    /**
     * Get available activities
     * @return bool|Response
     */
    public function get()
    {
        return $this
            ->service
            ->setPath('activity')
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }
}