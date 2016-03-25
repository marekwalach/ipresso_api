<?php

namespace iPresso;

class Action
{
    const VAR_KEY = 'key';
    const VAR_NAME = 'name';
    const VAR_PARAMETER = 'parameter';
    const VAR_TYPE = 'type';

    /**
     * ACTION TYPES
     */
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DICTIONARY = 'dictionary';
    const TYPE_INTEGER = 'integer';
    const TYPE_STRING = 'string';

    public $action;
    private $key;
    private $name;
    private $parameter = [];

    private static $parameter_types = [
        self::TYPE_DECIMAL,
        self::TYPE_DICTIONARY,
        self::TYPE_INTEGER,
        self::TYPE_STRING
    ];

    /**
     * @return array
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param array $parameter
     * @return Action
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
     * @return Action
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
     * @return Action
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
     * @return $this
     * @throws \Exception
     */
    public function addParameter($name, $key, $type, $options = [])
    {
        $param = [];
        $param[self::VAR_NAME] = $name;
        $param[self::VAR_KEY] = $key;

        if (!in_array($type, self::$parameter_types))
            throw new \Exception('Wrong parameter type.');

        $param[self::VAR_TYPE] = $type;

        if (!empty($options))
            $param[self::VAR_PARAMETER] = $options;

        $this->parameter[] = $param;
        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAction()
    {
        if (empty($this->name))
            throw new \Exception('Wrong action name.');

        $this->action[self::VAR_NAME] = $this->name;

        if (empty($this->key))
            throw new \Exception('Wrong action key.');

        $this->action[self::VAR_KEY] = $this->key;

        if (!empty($this->parameter))
            $this->action[self::VAR_PARAMETER] = $this->parameter;

        return $this->action;
    }
}