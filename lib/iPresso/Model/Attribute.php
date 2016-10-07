<?php

namespace iPresso\Model;

class Attribute
{
    const VAR_KEY = 'key';
    const VAR_NAME = 'name';
    const VAR_TYPE = 'type';

    /**
     * ATTRIBUTE TYPES
     */
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_DATE = 'date';
    const TYPE_DATE_TIME = 'datetime';
    const TYPE_INTEGER = 'integer';
    const TYPE_MULTI_SELECT = 'multiselect';
    const TYPE_SELECT = 'select';
    const TYPE_STRING = 'string';
    const TYPE_TEXT = 'text';
    const TYPE_TIME = 'time';

    /**
     * Available attribute types
     * @var array
     */
    public static $attribute_types = [
        self::TYPE_CHECKBOX,
        self::TYPE_DATE,
        self::TYPE_DATE_TIME,
        self::TYPE_INTEGER,
        self::TYPE_MULTI_SELECT,
        self::TYPE_SELECT,
        self::TYPE_STRING,
        self::TYPE_TEXT,
        self::TYPE_TIME
    ];

    public $attribute;
    private $key;
    private $name;
    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Attribute
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return Attribute
     */
    public function setKey($key)
    {
        $this->key = $key;
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
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAttribute()
    {
        if (empty($this->name))
            throw new \Exception('Wrong attribute ' . self::VAR_NAME);

        $this->attribute[self::VAR_NAME] = $this->name;

        if (empty($this->key))
            throw new \Exception('Wrong attribute ' . self::VAR_KEY);

        $this->attribute[self::VAR_KEY] = $this->key;

        if (empty($this->type) || !in_array($this->type, self::$attribute_types))
            throw new \Exception('Wrong attribute ' . self::VAR_TYPE);

        $this->attribute[self::VAR_TYPE] = $this->type;

        return $this->attribute;
    }


}