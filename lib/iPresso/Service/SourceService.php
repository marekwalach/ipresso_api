<?php

namespace iPresso\Service;

class SourceService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * SourceService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get all contact sources
     * @return bool|Response
     */
    public function get()
    {
        return $this
            ->service
            ->setPath('origin')
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Get contacts from a given source
     * @param integer $idSource
     * @param integer|bool $page
     * @return bool|Response
     */
    public function getContact($idSource, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setPath('origin/' . $idSource . '/contact' . $page)
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }
}