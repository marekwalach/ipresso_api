<?php

namespace iPresso\Service;

use iPresso\Model\Agreement;

class AgreementService
{
    private $service;

    /**
     * AgreementService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Add new agreements
     * @param Agreement $agreement
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Agreement $agreement)
    {
        return $this
            ->service
            ->setRequestPath('agreement')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($agreement->getAgreement())
            ->request();
    }
}