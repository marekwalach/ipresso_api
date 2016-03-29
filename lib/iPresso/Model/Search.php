<?php

namespace iPresso\Model;

class Search
{
    const VAR_EMAIL = 'email';
    const VAR_FIRST_NAME = 'fname';
    const VAR_LAST_NAME = 'lname';
    const VAR_NAME = 'name';
    const VAR_PHONE = 'phone';
    const VAR_ID_CONTACT_FROM = 'idContactFrom';
    const VAR_ID_CONTACT_TO = 'idContactTo';
    const VAR_CREATE_DATE_FROM = 'createDateFrom';
    const VAR_CREATE_DATE_TO = 'createDateTo';
    const VAR_ID_CATEGORY = 'id_category';
    const VAR_TYPE = 'type';
    const VAR_TAG = 'tag';

    public $search = [];

    /**
     * Original date of contact addition, in relation to which the search is to be conducted. Date format: YYYY-MM-YY; e.g. 2014-03-01
     * @var string
     */
    private $create_date_from = '';

    /**
     * Final date of contact addition, in relation to which the search is to be conducted. Date format: YYYY-MM-YY; e.g. 2014-03-01
     * @var string
     */
    private $create_date_to = '';

    /**
     * Email address
     * @var string
     */
    private $email = '';

    /**
     * First name
     * @var string
     */
    private $first_name = '';

    /**
     * ID of category
     * @var integer
     */
    private $id_category;

    /**
     *    Original ID of a contact, in relation to which the search is to be conducted.
     * @var integer
     */
    private $id_contact_from;

    /**
     * Final ID of a contact, in relation to which the search is to be conducted.
     * @var integer
     */
    private $id_contact_to;

    /**
     * Last name
     * @var string
     */
    private $last_name = '';

    /**
     * Name
     * @var string
     */
    private $name = '';

    /**
     * Phone number
     * @var string
     */
    private $phone = '';

    /**
     * Type of contact (enter type key)
     * @var string
     */
    private $type = '';

    /**
     * Tag of contact (enter name of tag)
     * @var string
     */
    private $tag = '';

    /**
     * @param mixed $tag
     * @return Search
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @param mixed $create_date_from
     * @return Search
     */
    public function setCreateDateFrom($create_date_from)
    {
        $this->create_date_from = $create_date_from;
        return $this;
    }

    /**
     * @param mixed $create_date_to
     * @return Search
     */
    public function setCreateDateTo($create_date_to)
    {
        $this->create_date_to = $create_date_to;
        return $this;
    }

    /**
     * @param mixed $email
     * @return Search
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param mixed $first_name
     * @return Search
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @param mixed $id_category
     * @return Search
     */
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
        return $this;
    }

    /**
     * @param mixed $id_contact_from
     * @return Search
     */
    public function setIdContactFrom($id_contact_from)
    {
        $this->id_contact_from = $id_contact_from;
        return $this;
    }

    /**
     * @param mixed $id_contact_to
     * @return Search
     */
    public function setIdContactTo($id_contact_to)
    {
        $this->id_contact_to = $id_contact_to;
        return $this;
    }

    /**
     * @param mixed $last_name
     * @return Search
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @param mixed $name
     * @return Search
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $phone
     * @return Search
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param mixed $type
     * @return Search
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCriteria()
    {
        if (!empty($this->first_name))
            $this->search[self::VAR_FIRST_NAME] = $this->first_name;

        if (!empty($this->last_name))
            $this->search[self::VAR_LAST_NAME] = $this->last_name;

        if (!empty($this->name))
            $this->search[self::VAR_NAME] = $this->name;

        if (!empty($this->phone))
            $this->search[self::VAR_PHONE] = $this->phone;

        if (!empty($this->id_contact_from))
            $this->search[self::VAR_ID_CONTACT_FROM] = $this->id_contact_from;

        if (!empty($this->id_contact_to))
            $this->search[self::VAR_ID_CONTACT_TO] = $this->id_contact_to;

        if (!empty($this->create_date_from))
            $this->search[self::VAR_CREATE_DATE_FROM] = $this->create_date_from;

        if (!empty($this->create_date_to))
            $this->search[self::VAR_CREATE_DATE_TO] = $this->create_date_to;

        if (!empty($this->id_category))
            $this->search[self::VAR_ID_CATEGORY] = $this->id_category;

        if (!empty($this->type))
            $this->search[self::VAR_TYPE] = $this->type;

        if (!empty($this->tag))
            $this->search[self::VAR_TAG] = $this->tag;

        if (empty($this->search))
            throw new \Exception('Empty criteria.');

        return $this->search;
    }
}
