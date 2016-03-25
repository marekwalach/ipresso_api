<?php

namespace iPresso;

class Activity
{
    const VAR_KEY = 'key';
    const VAR_NAME = 'name';
    const VAR_PARAMETER = 'parameter';
    const VAR_TYPE = 'type';

    /**
     * ACTIVITY TYPES
     */
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DICTIONARY = 'dictionary';
    const TYPE_INTEGER = 'integer';
    const TYPE_STRING = 'string';

    public $activity;
    private $key;
    private $name;
    private $parameter = [];

    /**
     * @return array
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param array $parameter
     * @return Activity
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;
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
     * @return Activity
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
     * @return Activity
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $name
     * @param string $key
     * @param string $type
     * @param array $options
     * @return Activity
     */
    public function addParameter($name, $key, $type, $options = [])
    {
        $param = [];
        $param[self::VAR_NAME] = $name;
        $param[self::VAR_KEY] = $key;
        $param[self::VAR_TYPE] = self::_validateType($type);

        if (!empty($options))
            $param[self::VAR_PARAMETER] = $options;

        $this->parameter[] = $param;
        return $this;
    }

    /**
     * @param string $type
     * @return bool
     * @throws \Exception
     */
    private static function _validateType($type)
    {
        switch ($type) {
            case self::TYPE_DECIMAL:
            case self::TYPE_DICTIONARY:
            case self::TYPE_INTEGER:
            case self::TYPE_STRING:
                return true;
            default:
                throw new \Exception('Wrong parameter type.');
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getActivity()
    {
        if (empty($this->name))
            throw new \Exception('Wrong activity name.');

        $this->activity[self::VAR_NAME] = $this->name;

        if (empty($this->key))
            throw new \Exception('Wrong activity key.');

        $this->activity[self::VAR_KEY] = $this->key;

        if (!empty($this->parameter))
            $this->activity[self::VAR_PARAMETER] = $this->parameter;

        return $this->activity;
    }
}