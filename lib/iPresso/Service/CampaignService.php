<?php

namespace iPresso\Service;

use iPresso\Model\Campaign;
use Itav\Component\Serializer\Serializer;

/**
 * Class CampaignService
 * @package iPresso\Service
 */
class CampaignService implements ServiceInterface
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
     * CampaignService constructor.
     * @param Service $service
     * @param Serializer $serializer
     */
    public function __construct(Service $service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
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
            ->setRequestPath('campaign/' . $idCampaign . '/send' . $key)
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($campaign->getCampaign())
            ->request();
    }
}