<?php

namespace iPresso\Service;

use iPresso\Model\Campaign;

class CampaignService
{
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
     * @param $idCampaign
     * @param Campaign $campaign
     * @return bool|mixed
     */
    public function send($idCampaign, Campaign $campaign)
    {
        return $this
            ->service
            ->setRequestPath('campaign/' . $idCampaign . '/send')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($campaign->getCampaign())
            ->request();
    }
}