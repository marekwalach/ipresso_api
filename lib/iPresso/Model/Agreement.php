<?php

namespace iPresso\Model;

class Agreement
{
    const VAR_DESCRIPTION = 'description';
    const VAR_DM_STATUS = 'dmvisible';
    const VAR_NAME = 'name';

    const DIRECT_MARKETING_VISIBLE = 1;
    const DIRECT_MARKETING_NON_VISIBLE = 0;

    /**
     * @var array
     */
    public static $dm_status_types = [
        self::DIRECT_MARKETING_NON_VISIBLE,
        self::DIRECT_MARKETING_VISIBLE
    ];

    /**
     * @var array
     */
    public $agreement = [];

    /**
     * Parameter `AGREEMENT_NAME` should be replaced with the name of an agreement.
     * @var string
     */
    private $name = '';

    /**
     * Parameter `AGREEMENT_DESCRIPTION` should be replaced with the content of an agreement.
     * @var string
     */
    private $description = '';

    /**
     * Parameter `DM_VISIBLE_STATUS` defines whether agreement allows sending message: 0 if it doesn’t, 1 if it does.
     * @var int
     */
    private $dm_status = 1;

    /**
     * @return mixed
     */
    public function getDmStatus()
    {
        return $this->dm_status;
    }

    /**
     * @param mixed $dm_status
     * @return Agreement
     */
    public function setDmStatus($dm_status)
    {
        $this->dm_status = $dm_status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Agreement
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Agreement
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAgreement()
    {
        if (empty($this->name))
            throw new \Exception('Wrong agreement name.');

        $this->agreement[self::VAR_NAME] = $this->name;

        if (empty($this->description))
            throw new \Exception('Wrong agreement description.');

        $this->agreement[self::VAR_DESCRIPTION] = $this->description;

        if (empty($this->dm_status) || !in_array($this->dm_status, self::$dm_status_types))
            throw new \Exception('Wrong direct marketing visible status.');

        $this->agreement[self::VAR_DM_STATUS] = $this->dm_status;

        return $this->agreement;
    }
}