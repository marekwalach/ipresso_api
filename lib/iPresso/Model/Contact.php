<?php

namespace iPresso\Model;

class Contact
{
    const VAR_TYPE = 'type';
    const VAR_FIRST_NAME = 'fname';
    const VAR_LAST_NAME = 'lname';
    const VAR_NAME = 'name';
    const VAR_EMAIL = 'email';
    const VAR_PHONE = 'phone';
    const VAR_MOBILE = 'mobile';
    const VAR_COMPANY = 'company';
    const VAR_CITY = 'city';
    const VAR_POST_CODE = 'postCode';
    const VAR_STREET = 'street';
    const VAR_BUILDING_NUMBER = 'buildingNumber';
    const VAR_FLAT_NUMBER = 'flatNumber';
    const VAR_COUNTRY = 'country';
    const VAR_CATEGORY = 'category';
    const VAR_TAG = 'tag';
    const VAR_AGREEMENT = 'agreement';

    /**
     * @required * - one of the above fields must be sent
     * @var array
     */
    public $contact = [];

    /**
     * iPresso API null variable
     * @var string
     */
    public static $null = 'API_NULL';

    /**
     * @var array
     */
    private $attribute = [];

    /**
     * Building number
     * @var string
     */
    private $building_number = '';

    /**
     * City
     * @var string
     */
    private $city = '';

    /**
     * Name of company
     * @var string
     */
    private $company = '';

    /**
     * Country
     * @var string
     */
    private $country = '';

    /**
     * E-mail address
     * @required *
     * @var string
     */
    private $email = '';

    /**
     * Flat number
     * @var string
     */
    private $flat_number = '';

    /**
     * First name
     * @var string
     */
    private $first_name = '';

    /**
     * Last name
     * @required *
     * @var string
     */
    private $last_name = '';

    /**
     * Mobile phone number
     * @required *
     * @var string
     */
    private $mobile = '';

    /**
     * Own name
     * @required *
     * @var string
     */
    private $name = '';

    /**
     * Landline phone number
     * @var string
     */
    private $phone = '';

    /**
     * Post code
     * @var string
     */
    private $post_code = '';

    /**
     * Street
     * @var string
     */
    private $street = '';

    /**
     * Key of contact’s type
     * @var string
     */
    private $type = '';

    /**
     * Associative array with a pair - agreement IDs => agreement status, where 1 = add agreement, 2 = delete agreement
     * @var array
     */
    private $agreement = [];

    /**
     * Associative array with a pair - category ID => category status, where 1 = add category, 2 = delete category
     * @var array
     */
    private $category = [];

    /**
     * One-dimensional array containing tag
     * @var array
     */
    private $tag = [];

    /**
     * @param string $building_number
     * @return Contact
     */
    public function setBuildingNumber($building_number)
    {
        $this->building_number = $building_number;
        return $this;
    }

    /**
     * @param string $city
     * @return Contact
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $company
     * @return Contact
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @param string $country
     * @return Contact
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param $email
     * @return Contact
     * @throws \Exception
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new \Exception('Wrong email address');

        $this->email = $email;
        return $this;
    }

    /**
     * @param string $flat_number
     * @return Contact
     */
    public function setFlatNumber($flat_number)
    {
        $this->flat_number = $flat_number;
        return $this;
    }

    /**
     * @param string $first_name
     * @return Contact
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @param string $last_name
     * @return Contact
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @param string $mobile
     * @return Contact
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @param string $name
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $phone
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string $post_code
     * @return Contact
     */
    public function setPostCode($post_code)
    {
        $this->post_code = $post_code;
        return $this;
    }

    /**
     * @param string $street
     * @return Contact
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param string $type
     * @return Contact
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param array $agreement
     * @return Contact
     */
    public function setAgreement($agreement)
    {
        $this->agreement = $agreement;
        return $this;
    }

    /**
     * @param integer $id_agreement
     * @param integer $status
     * @return Contact
     */
    public function addAgreement($id_agreement, $status)
    {
        $this->agreement[$id_agreement] = $status;
        return $this;
    }

    /**
     * @param array $category
     * @return Contact
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param integer $id_category
     * @param integer $status
     * @return $this
     */
    public function addCategory($id_category, $status)
    {
        $this->category[$id_category] = $status;
        return $this;
    }

    /**
     * @param array $tag
     * @return Contact
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @param string $tag
     * @return Contact
     */
    public function addTag($tag)
    {
        $this->tag[] = $tag;
        return $this;
    }

    /**
     * Set variable to NULL
     * @param $variable
     */
    public function setNull($variable)
    {
        if (isset($this->{$variable}))
            $this->{$variable} = self::$null;
    }

    /**
     * @param string $apiKey
     * @param mixed $value
     * @return $this
     */
    public function setAttribute($apiKey, $value)
    {
        $this->attribute[$apiKey] = $value;
        return $this;
    }

    /**
     * @param string $apiKey
     * @return mixed
     */
    public function getAttribute($apiKey)
    {
        return $this->attribute[$apiKey];
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function getContact()
    {
        if (!empty($this->type))
            $this->contact[self::VAR_TYPE] = $this->type;

        if (!empty($this->first_name))
            $this->contact[self::VAR_FIRST_NAME] = $this->first_name;

        if (!empty($this->last_name))
            $this->contact[self::VAR_LAST_NAME] = $this->last_name;

        if (!empty($this->name))
            $this->contact[self::VAR_NAME] = $this->name;

        if (!empty($this->email))
            $this->contact[self::VAR_EMAIL] = $this->email;

        if (!empty($this->phone))
            $this->contact[self::VAR_PHONE] = $this->phone;

        if (!empty($this->mobile))
            $this->contact[self::VAR_MOBILE] = $this->mobile;

        if (!empty($this->company))
            $this->contact[self::VAR_COMPANY] = $this->company;

        if (!empty($this->city))
            $this->contact[self::VAR_CITY] = $this->city;

        if (!empty($this->post_code))
            $this->contact[self::VAR_POST_CODE] = $this->post_code;

        if (!empty($this->flat_number))
            $this->contact[self::VAR_FLAT_NUMBER] = $this->flat_number;

        if (!empty($this->country))
            $this->contact[self::VAR_COUNTRY] = $this->country;

        if (!empty($this->category))
            $this->contact[self::VAR_CATEGORY] = $this->category;

        if (!empty($this->tag))
            $this->contact[self::VAR_TAG] = $this->tag;

        if (!empty($this->agreement))
            $this->contact[self::VAR_AGREEMENT] = $this->agreement;

        if (!empty($this->attribute)) {
            foreach ($this->attribute as $apiKey => $value) {
                $this->contact[$apiKey] = $value;
            }
        }

        return $this->contact;
    }

}