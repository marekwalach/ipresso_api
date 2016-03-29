<?php

use Service\ActionService;
use Service\ActivityService;
use Service\AgreementService;
use Service\AttributeService;
use Service\CampaignService;
use Service\ContactService;
use Service\Service;

class iPresso
{
    public $action;
    public $activity;
    public $agreement;
    public $attribute;
    public $campaign;
    public $contact;
    private $service;

    public function __construct()
    {
        $this->action = new ActionService();
        $this->activity = new ActivityService();
        $this->agreement = new AgreementService();
        $this->attribute = new AttributeService();
        $this->campaign = new CampaignService();
        $this->contact = new ContactService();
        $this->service = new Service();
    }

    /**
     * @param mixed $customerKey
     * @return iPresso
     */
    public function setCustomerKey($customerKey)
    {
        $this->service->setCustomerKey($customerKey);
        return $this;
    }

    /**
     * @param mixed $login
     * @return iPresso
     */
    public function setLogin($login)
    {
        $this->service->setLogin($login);
        return $this;
    }

    /**
     * @param mixed $password
     * @return iPresso
     */
    public function setPassword($password)
    {
        $this->service->setPassword($password);
        return $this;
    }

    /**
     * @param mixed $token
     * @return iPresso
     */
    public function setToken($token)
    {
        $this->service->setToken($token);
        return $this;
    }

    /**
     * @param mixed $url
     * @return iPresso
     */
    public function setUrl($url)
    {
        $this->service->setUrl($url);
        return $this;
    }

    public static function dump($die, $variable, $desc = false, $noHtml = false)
    {
        if (is_string($variable)) {
            $variable = str_replace("<_new_line_>", "<BR>", $variable);
        }

        if ($noHtml) {
            echo "\n";
        } else {
            echo "<pre>";
        }

        if ($desc) {
            echo $desc . ": ";
        }

        print_r($variable);

        if ($noHtml) {
            echo "";
        } else {
            echo "</pre>";
        }

        if ($die) {
            die();
        }
    }

}