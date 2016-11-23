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
            ->setPath('segmentation')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($segmentation->getSegmentation())
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
            ->setPath('segmentation/' . $idSegmentation)
            ->setMethod(Service::REQUEST_METHOD_DELETE)
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
            ->setPath('segmentation/' . $idSegmentation . '/contact')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($segmentation->getSegmentationContact())
            ->request();
    }
}