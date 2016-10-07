<?php

namespace iPresso\Service;

class WebsiteService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * WebsiteService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get monitored websites
     * @param integer|bool $idWww
     * @return bool|Response
     */
    public function get($idWww = false)
    {
        if ($idWww && is_numeric($idWww))
            $idWww = '/' . $idWww;
        return $this
            ->service
            ->setRequestPath('www' . $idWww)
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Add monitored website
     * @param string $url
     * @return bool|Response
     * @throws \Exception
     */
    public function add($url)
    {
        if (!$url || !filter_var($url, FILTER_VALIDATE_URL))
            throw new \Exception('Set correct URL.');

        $data = [];
        $data['www']['url'] = $url;

        return $this
            ->service
            ->setRequestPath('www')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Delete monitored website
     * @param integer $idWww
     * @return bool|Response
     */
    public function delete($idWww)
    {
        return $this
            ->service
            ->setRequestPath('www/' . $idWww)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

}