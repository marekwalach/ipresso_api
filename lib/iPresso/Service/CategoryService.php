<?php

namespace iPresso\Service;

use iPresso\Model\Category;

class CategoryService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * CategoryService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get category
     * @param integer|bool $idCategory
     * @return bool|Response
     */
    public function get($idCategory = false)
    {
        if ($idCategory && is_numeric($idCategory))
            $idCategory = '/' . $idCategory;

        return $this
            ->service
            ->setPath('category' . $idCategory)
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Add new category
     * @param Category $category
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Category $category)
    {
        return $this
            ->service
            ->setPath('category')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($category->getCategory())
            ->request();
    }

    /**
     * Edit selected category
     * @param integer $idCategory
     * @param Category $category
     * @return bool|Response
     * @throws \Exception
     */
    public function edit($idCategory, Category $category)
    {
        return $this
            ->service
            ->setPath('category/' . $idCategory)
            ->setMethod(Service::REQUEST_METHOD_PUT)
            ->setData(['category' => $category->getCategory()])
            ->request();
    }

    /**
     * Delete category
     * @param integer $idCategory
     * @return bool|Response
     */
    public function delete($idCategory)
    {
        return $this
            ->service
            ->setPath('category/' . $idCategory)
            ->setMethod(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Add new contacts to categories
     * @param integer $idCategory
     * @param array $contactIds
     * @return bool|Response
     * @throws \Exception
     */
    public function addContact($idCategory, $contactIds)
    {
        if (!is_array($contactIds) || empty($contactIds))
            throw new \Exception('Set idContacts array first.');

        $data['contact'] = $contactIds;
        return $this
            ->service
            ->setPath('category/' . $idCategory . '/contact')
            ->setMethod(Service::REQUEST_METHOD_POST)
            ->setData($data)
            ->request();
    }

    /**
     * Get all contacts in category
     * @param integer $idCategory
     * @param integer|bool $page
     * @return bool|Response
     */
    public function getContact($idCategory, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setPath('category/' . $idCategory . '/contact' . $page)
            ->setMethod(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Delete contact in category
     * @param integer $idCategory
     * @param integer $idContact
     * @return bool|Response
     */
    public function deleteContact($idCategory, $idContact)
    {
        return $this
            ->service
            ->setPath('category/' . $idCategory . '/contact/' . $idContact)
            ->setMethod(Service::REQUEST_METHOD_DELETE)
            ->request();
    }
}