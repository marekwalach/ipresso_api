<?php

namespace Service;

use Model\Agreement;

class AgreementService extends Service
{
    /**
     * Add new agreements
     * @param Agreement $agreement
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Agreement $agreement)
    {
        return $this
            ->setRequestPath('agreement')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($agreement->getAgreement())
            ->request();
    }
}