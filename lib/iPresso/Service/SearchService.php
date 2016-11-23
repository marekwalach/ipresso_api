<?php

namespace iPresso\Service;

use iPresso\Model\Search;

class SearchService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * SearchService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Searching contacts by criteria
     * @param Search $search
     * @param bool $extended
     * @return bool|Response
     * @throws \Exception
     */
    public function search(Search $search, $extended = false)
    {
        if ($extended)
            $extended = '/extended';

        return $this
            ->service
            ->setPath('contact/search' . $extended)
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData(['contact' => $search->getCriteria()])
            ->request();
    }

}