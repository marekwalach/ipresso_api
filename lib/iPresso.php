<?php

use iPresso\Service\ActionService;
use iPresso\Service\ActivityService;
use iPresso\Service\AgreementService;
use iPresso\Service\AttributeService;
use iPresso\Service\CategoryService;
use iPresso\Service\CampaignService;
use iPresso\Service\ContactService;
use iPresso\Service\SearchService;
use iPresso\Service\SourceService;
use iPresso\Service\TagService;
use iPresso\Service\TypeService;
use iPresso\Service\WebsiteService;
use iPresso\Service\Service;

class iPresso
{
    public $action;
    public $activity;
    public $agreement;
    public $attribute;
    public $campaign;
    public $category;
    public $contact;
    public $search;
    public $source;
    public $tag;
    public $type;
    public $www;
    private $service;

    /**
     * iPresso constructor.
     */
    public function __construct()
    {
        $this->service = new Service();
        $this->action = new ActionService($this->service);
        $this->activity = new ActivityService($this->service);
        $this->agreement = new AgreementService($this->service);
        $this->attribute = new AttributeService($this->service);
        $this->category = new CategoryService($this->service);
        $this->campaign = new CampaignService($this->service);
        $this->contact = new ContactService($this->service);
        $this->search = new SearchService($this->service);
        $this->source = new SourceService($this->service);
        $this->tag = new TagService($this->service);
        $this->type = new TypeService($this->service);
        $this->www = new WebsiteService($this->service);
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

    /**
     * @return $this
     */
    public function debug()
    {
        $this->service->debug();
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