<?php

namespace Service;

use Model\Campaign;

class CampaignService extends Service
{
    /**
     * Send intentable direct marketing campaign
     * @param $idCampaign
     * @param Campaign $campaign
     * @return bool|mixed
     */
    public function send($idCampaign, Campaign $campaign)
    {
        return $this
            ->setRequestPath('campaign/' . $idCampaign . '/send')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($campaign->getCampaign())
            ->request();
    }
}