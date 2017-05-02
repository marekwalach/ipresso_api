<?php

namespace iPresso\Service;

use iPresso\Model\Activity;
use Itav\Component\Serializer\Serializer;

/**
 * Class ActivityService
 * @package iPresso\Service
 */
class ActivityService implements ServiceInterface
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
     * ActivityService constructor.
     * @param Service $service
     * @param Serializer $serializer
     */
    public function __construct(Service $service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
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
            ->setRequestPath('activity')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($activity->getActivity())
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
            ->setRequestPath('activity')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }
}