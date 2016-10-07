<?php

namespace iPresso\Service;

use iPresso\Model\Contact;
use iPresso\Model\ContactAction;
use iPresso\Model\ContactActivity;

class ContactService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * ContactService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Adding new contact
     * @param Contact|array $contact
     * @return bool|Response
     * @throws \Exception
     */
    public function add($contact)
    {
        $post_data = [];

        if (is_array($contact)) {
            foreach ($contact as $c)
                $post_data['contact'][] = $c->getContact();
        } else {
            $post_data['contact'][] = $contact->getContact();
        }

        return $this
            ->service
            ->setRequestPath('contact')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($post_data)
            ->request();
    }

    /**
     * Edition of a contact with a given ID number
     * @param $id_contact
     * @param Contact $contact
     * @return bool|Response
     * @throws \Exception
     */
    public function edit($id_contact, Contact $contact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(Service::REQUEST_METHOD_PUT)
            ->setPostData(['contact' => $contact->getContact()])
            ->request();
    }

    /**
     * Delete contact
     * @param $id_contact
     * @return bool|Response
     */
    public function delete($id_contact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Collect contact’s data with a given ID number
     * @param integer $id_contact
     * @return bool|Response
     */
    public function get($id_contact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Adding tags to contacts with a given ID
     * @param integer $idContact
     * @param string $tagString
     * @return bool|Response
     */
    public function addTag($idContact, $tagString)
    {
        $data['tag'] = [$tagString];
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/tag')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Collecting tags for a contact
     * @param integer $idContact
     * @return bool|Response
     */
    public function getTag($idContact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/tag')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Deleting contact’s tag
     * @param integer $idContact
     * @param integer $idTag
     * @return bool|Response
     */
    public function deleteTag($idContact, $idTag)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/tag/' . $idTag)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Adding category to a contact
     * @param integer $idContact
     * @param array $categoryIds
     * @return bool|Response
     */
    public function addCategory($idContact, $categoryIds)
    {
        $data['category'] = $categoryIds;
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/category')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Get category for a contact
     * @param integer $idContact
     * @return bool|Response
     */
    public function getCategory($idContact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/category')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Deleting contact’s category
     * @param integer $idContact
     * @param integer $idCategory
     * @return bool|Response
     */
    public function deleteCategory($idContact, $idCategory)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/category/' . $idCategory)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Get integration of the contact
     * @param integer $idContact
     * @return bool|Response
     */
    public function getIntegration($idContact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/integration')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Adding agreements to contacts
     * Parameter `ID_AGREEMENT` should be replaced with ID number of the agreement.
     * Then add status of the agreement. In the case of acceptance the status equals 1.
     * Parameter `ID_AGREEMENT_STATUS` is agreement status, in the case of activation of agreement enter number 1, in other cases enter 2.
     * @param integer $idContact
     * @param array $agreement [ID_AGREEMENT => ID_AGREEMENT_STATUS]
     * @return bool|Response
     */
    public function addAgreement($idContact, $agreement)
    {
        $data['agreement'] = $agreement;
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/agreement')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Get contact’s agreements
     * @param integer $idContact
     * @return bool|Response
     */
    public function getAgreement($idContact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/agreement')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Delete agreement of a given ID from a contact of a given ID
     * @param integer $idContact
     * @param integer $idAgreement
     * @return bool|Response
     */
    public function deleteAgreement($idContact, $idAgreement)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/agreement/' . $idAgreement)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Adding activity to a contact
     * @param integer $idContact
     * @param ContactActivity $contactActivity
     * @return bool|Response
     * @throws \Exception
     */
    public function addActivity($idContact, ContactActivity $contactActivity)
    {
        $data['activity'][] = $contactActivity->getContactActivity();
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/activity')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }


    /**
     * Get available activities
     * @param integer $idContact
     * @param integer|bool $page
     * @return bool|Response
     */
    public function getActivity($idContact, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/activity' . $page)
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Add actions to contact
     * @param integer $idContact
     * @param ContactAction $contactAction
     * @return bool|Response
     * @throws \Exception
     */
    public function addAction($idContact, ContactAction $contactAction)
    {
        $data['action'][] = $contactAction->getContactAction();
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/action')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Get available actions
     * @param integer $idContact
     * @param integer|bool $page
     * @return bool|Response
     */
    public function getAction($idContact, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/action' . $page)
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Get contact type
     * @param integer $idContact
     * @return bool|Response
     */
    public function getType($idContact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/type')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Setting contact type
     * @param integer $idContact
     * @param string $typeKey
     * @return bool|Response
     */
    public function setType($idContact, $typeKey)
    {
        $data['type'] = $typeKey;
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/type')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Get connections between contacts
     * @param integer $idContact
     * @return bool|Response
     */
    public function getConnection($idContact)
    {
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/connection')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Connect contacts
     * @param integer $idContact
     * @param integer $idContactToConnect
     * @return bool|Response
     */
    public function setConnection($idContact, $idContactToConnect)
    {
        $data['connection'] = [$idContactToConnect];
        return $this
            ->service
            ->setRequestPath('contact/' . $idContact . '/connection')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }
}