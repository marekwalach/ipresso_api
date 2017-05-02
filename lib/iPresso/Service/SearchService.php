<?php

namespace iPresso\Service;

use iPresso\Model\Search;
use Itav\Component\Serializer\Serializer;

/**
 * Class SearchService
 * @package iPresso\Service
 */
class SearchService implements ServiceInterface
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
     * SearchService constructor.
     * @param Service $service
     * @param Serializer $serializer
     */
    public function __construct(Service $service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
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