<?php

namespace iPresso\Service;

use iPresso\Model\Type;

class TypeService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * TypeService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get all contact types with their dynamic and static attributes
     * @return bool|Response
     */
    public function get()
    {
        return $this
            ->service
            ->setPath('type')
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Add new type of contact
     * @param Type $type
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Type $type)
    {
        return $this
            ->service
            ->setPath('type')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($type->getType())
            ->request();
    }

    /**
     * Get contacts of a given type
     * @param integer $idType
     * @param bool $page
     * @return bool|Response
     */
    public function getContact($idType, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setPath('type/' . $idType . '/contact' . $page)
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Assignee contact type to a contact
     * @param string $typeKey
     * @param array $contactIds
     * @return bool|Response
     * @throws \Exception
     */
    public function addContact($typeKey, $contactIds)
    {
        if (!is_array($contactIds) || empty($contactIds))
            throw new \Exception('Set idContacts array first.');

        $data['contact'] = $contactIds;
        return $this
            ->service
            ->setPath('type/' . $typeKey . '/contact')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($data)
            ->request();
    }
}