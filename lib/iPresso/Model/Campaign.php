<?php

namespace iPresso\Model;

class Campaign
{
    const VAR_EMAIL = 'email';
    const VAR_ID_CONTACT = 'contactId';
    const VAR_MOBILE = 'phone';
    const VAR_CONTENT = 'content';

    public $campaign = [];
    private $content = [];
    private $email = [];
    private $id_contact = [];
    private $mobile = [];

    /**
     * @return array
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param array $email
     * @return Campaign
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param array $content
     * @return Campaign
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getIdContact()
    {
        return $this->id_contact;
    }

    /**
     * @param array $id_contact
     * @return Campaign
     */
    public function setIdContact($id_contact)
    {
        $this->id_contact = $id_contact;
        return $this;
    }

    /**
     * @return array
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param array $mobile
     * @return Campaign
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @param string $bracket
     * @param string $value
     * @return Campaign
     */
    public function addContent($bracket, $value)
    {
        $this->content[$bracket] = $value;
        return $this;
    }

    /**
     * @param $email
     * @return Campaign
     */
    public function addEmail($email)
    {
        $this->email[] = $email;
        return $this;
    }

    /**
     * @param $mobile
     * @return Campaign
     */
    public function addMobile($mobile)
    {
        $this->mobile[] = $mobile;
        return $this;
    }

    /**
     * @param $idContact
     * @return Campaign
     */
    public function addIdContact($idContact)
    {
        $this->id_contact[] = $idContact;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCampaign()
    {
        if (!empty($this->content))
            $this->campaign[self::VAR_CONTENT] = $this->content;

        if (!empty($this->email))
            $this->campaign[self::VAR_EMAIL] = $this->email;

        if (!empty($this->id_contact))
            $this->campaign[self::VAR_ID_CONTACT] = $this->id_contact;

        if (!empty($this->mobile))
            $this->campaign[self::VAR_MOBILE] = $this->mobile;

        if (empty($this->campaign))
            throw new \Exception('No recipients in campaign');

        return $this->campaign;
    }
}
