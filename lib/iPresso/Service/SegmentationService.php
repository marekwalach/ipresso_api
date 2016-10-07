<?php

namespace iPresso\Service;

use iPresso\Model\Segmentation;

class SegmentationService
{
    /**
     * @var Service
     */
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
     * @param Segmentation $segmentation
     * @return bool|Response
     */
    public function add(Segmentation $segmentation)
    {
        return $this
            ->service
            ->setRequestPath('segmentation')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($segmentation->getSegmentation())
            ->request();
    }

    /**
     * @param integer $idSegmentation
     * @return bool|Response
     */
    public function delete($idSegmentation)
    {
        return $this
            ->service
            ->setRequestPath('segmentation/' . $idSegmentation)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * @param integer $idSegmentation
     * @param Segmentation $segmentation
     * @return bool|Response
     * @throws \Exception
     */
    public function addContact($idSegmentation, Segmentation $segmentation)
    {
        if(!is_numeric($idSegmentation))
            throw new \Exception('Wrong segmentation id.');

        return $this
            ->service
            ->setRequestPath('segmentation/' . $idSegmentation . '/contact')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($segmentation->getSegmentationContact())
            ->request();
    }
}