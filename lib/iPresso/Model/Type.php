<?php

namespace iPresso\Model;

class Type
{
    const VAR_ATTRIBUTE = 'attribute';
    const VAR_KEY = 'key';
    const VAR_NAME = 'name';

    public $type;
    private $attribute = [];
    private $key;
    private $name;

    /**
     * @param string $name
     * @return Type
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param array $attribute_key
     * @return Type
     */
    public function setAttribute($attribute_key)
    {
        $this->attribute = $attribute_key;
        return $this;
    }

    /**
     * @param string $key
     * @return Type
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function addAttribute($attribute_key)
    {
        $this->attribute[] = $attribute_key;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getType()
    {
        if (empty($this->name))
            throw new \Exception('Wrong type name.');

        $this->type[self::VAR_NAME] = $this->name;

        if (empty($this->key))
            throw new \Exception('Wrong type key.');

        $this->type[self::VAR_KEY] = $this->key;

        if (!empty($this->attribute))
            $this->type[self::VAR_ATTRIBUTE] = $this->attribute;

        return $this->type;
    }

}