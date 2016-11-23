<?php

namespace iPresso\Service;

use iPresso\Model\Campaign;

class CampaignService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * CampaignService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Send intentable direct marketing campaign
     * @param integer $idCampaign
     * @param Campaign $campaign
     * @param bool $key
     * @return bool|Response
     * @throws \Exception
     */
    public function send($idCampaign, Campaign $campaign, $key = false)
    {
        if ($key)
            $key = '?key=1';

        return $this
            ->service
            ->setPath('campaign/' . $idCampaign . '/send' . $key)
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($campaign->getCampaign())
            ->request();
    }
}