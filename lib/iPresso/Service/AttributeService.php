<?php

namespace Service;

use Model\Attribute;

class AttributeService extends Service
{

    /**
     * Add new attributes
     * @param Attribute $attribute
     * @return bool|mixed
     * @throws \Exception
     */
    public function add(Attribute $attribute)
    {
        return $this
            ->setRequestPath('attribute')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($attribute->getAttribute())
            ->request();
    }

    /**
     * Get available attributes
     * @return bool|mixed
     */
    public function getAll()
    {
        return $this
            ->setRequestPath('attribute')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }
}