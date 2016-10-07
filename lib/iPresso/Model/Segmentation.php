<?php

namespace iPresso\Model;

class Segmentation
{

    const CONTACT_ORIGIN_ID = 1;
    const CONTACT_ORIGIN_EMAIL = 2;

    const VAR_CONTACT = 'contacts';
    const VAR_LIVE_TIME = 'live_time';
    const VAR_NAME = 'name';
    const VAR_ORIGIN = 'contact_origin';
    const VAR_TYPE = 'contact_type';

    /**
     * @var array
     */
    public $segmentation = [];

    /**
     * @var array
     */
    private $contact = [];

    /**
     * @var integer
     */
    private $contact_origin;

    /**
     * @var string
     */
    private $contact_type;

    /**
     * @var integer
     */
    private $live_time;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private static $segmentation_origin = [
        self::CONTACT_ORIGIN_ID,
        self::CONTACT_ORIGIN_EMAIL,
    ];

    /**
     * @return array
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param array $contact
     * @return Segmentation
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @param mixed $idContact
     * @return Segmentation
     */
    public function addContact($idContact)
    {
        $this->contact[] = $idContact;
        return $this;
    }

    /**
     * @return int
     */
    public function getContactOrigin()
    {
        return $this->contact_origin;
    }

    /**
     * @param integer $contact_origin
     * @return $this
     * @throws \Exception
     */
    public function setContactOrigin($contact_origin)
    {
        if (!in_array($contact_origin, self::$segmentation_origin))
            throw new \Exception('Wrong ' . self::VAR_ORIGIN);

        $this->contact_origin = $contact_origin;
        return $this;
    }

    /**
     * @return int
     */
    public function getLiveTime()
    {
        return $this->live_time;
    }

    /**
     * @param int $live_time
     * @return Segmentation
     */
    public function setLiveTime($live_time)
    {
        $this->live_time = $live_time;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Segmentation
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getContactType()
    {
        return $this->contact_type;
    }

    /**
     * @param string $contact_type
     * @return Segmentation
     */
    public function setContactType($contact_type)
    {
        $this->contact_type = $contact_type;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSegmentation()
    {
        if (empty($this->name))
            throw new \Exception('Wrong segmentation ' . self::VAR_NAME);

        $this->segmentation[self::VAR_NAME] = $this->name;

        if (empty($this->live_time))
            throw new \Exception('Wrong segmentation ' . self::VAR_LIVE_TIME);

        $this->segmentation[self::VAR_LIVE_TIME] = $this->live_time;

        if (!empty($this->contact))
            $this->segmentation[self::VAR_CONTACT] = $this->contact;

        if (!empty($this->contact_origin))
            $this->segmentation[self::VAR_ORIGIN] = $this->contact_origin;

        if (!empty($this->contact_type))
            $this->segmentation[self::VAR_TYPE] = $this->contact_type;

        return $this->segmentation;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSegmentationContact()
    {
        if (empty($this->contact)) {
            throw new \Exception('No contacts in segmentation');
        }
        $this->segmentation[self::VAR_CONTACT] = $this->contact;

        if (empty($this->contact_origin)) {
            throw new \Exception('Wrong segmentation ' . self::VAR_ORIGIN);
        }
        $this->segmentation[self::VAR_ORIGIN] = $this->contact_origin;

        if (!empty($this->contact_type)) {
            $this->segmentation[self::VAR_TYPE] = $this->contact_type;
        }

        return $this->segmentation;
    }
}