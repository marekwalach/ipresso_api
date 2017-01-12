<?php

namespace iPresso\Model;

/**
 * Class ContactAttribute
 * @package iPresso\Model
 */
class ContactAttribute
{

    /**
     * @var string
     */
    private $key;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $optionsByKey;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return ContactAttribute
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ContactAttribute
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ContactAttribute
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return ContactAttribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return ContactAttribute
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptionsByKey()
    {
        return $this->optionsByKey;
    }

    /**
     * @param array $optionsByKey
     * @return ContactAttribute
     */
    public function setOptionsByKey($optionsByKey)
    {
        $this->optionsByKey = $optionsByKey;
        return $this;
    }
}