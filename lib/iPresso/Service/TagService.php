<?php

namespace iPresso\Service;

use iPresso\Model\Tag;

class TagService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * TagService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get tags
     * @param integer|bool $idTag
     * @return bool|Response
     */
    public function get($idTag = false)
    {
        if ($idTag && is_numeric($idTag))
            $idTag = '/' . $idTag;

        return $this
            ->service
            ->setPath('tag' . $idTag)
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Add new tag
     * @param Tag $tag
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Tag $tag)
    {
        $data['name'] = $tag;
        return $this
            ->service
            ->setPath('tag')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($tag->getTag())
            ->request();
    }

    /**
     * Edit selected tag
     * @param integer $idTag
     * @param Tag $tag
     * @return bool|Response
     * @throws \Exception
     */
    public function edit($idTag, Tag $tag)
    {
        return $this
            ->service
            ->setPath('tag/' . $idTag)
            ->setMethod(Service::REQUEST_METHOD_PUT)
            ->setData(['tag' => $tag->getTag()])
            ->request();
    }

    /**
     * Delete tag
     * @param integer $idTag
     * @return bool|Response
     */
    public function delete($idTag)
    {
        return $this
            ->service
            ->setPath('tag/' . $idTag)
            ->setMethod(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Add new contacts to a tag
     * @param integer $idTag
     * @param array $contactIds
     * @return bool|Response
     * @throws \Exception
     */
    public function addContact($idTag, $contactIds)
    {
        if (!is_array($contactIds) || empty($contactIds))
            throw new \Exception('Set idContacts array first.');

        $data['contact'] = $contactIds;
        return $this
            ->service
            ->setPath('tag/' . $idTag . '/contact')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($data)
            ->request();
    }

    /**
     * Get all contacts in tag
     * @param integer $idTag
     * @param integer|bool $page
     * @return bool|Response
     */
    public function getContact($idTag, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setPath('tag/' . $idTag . '/contact' . $page)
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Delete contact in tag
     * @param integer $idTag
     * @param integer $idContact
     * @return bool|Response
     */
    public function deleteContact($idTag, $idContact)
    {
        return $this
            ->service
            ->setPath('tag/' . $idTag . '/contact/' . $idContact)
            ->setMethod(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

}