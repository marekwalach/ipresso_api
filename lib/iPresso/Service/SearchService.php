<?php

namespace iPresso\Service;

use iPresso\Model\Search;

class SearchService
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
            ->setRequestPath('contact/search' . $extended)
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData(['contact' => $search->getCriteria()])
            ->request();
    }

}