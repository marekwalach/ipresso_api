<?php

namespace Service;

use Model\Contact;

class ContactService extends Service
{
    /**
     * Adding new contact
     * @param Contact $contact
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Contact $contact)
    {
        $post_data = [];
        $post_data['contact'][] = $contact->getContact();
        return $this
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
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Collect contact’s data with a given ID number
     * @param $id_contact
     * @return bool|Response
     */
    public function get($id_contact)
    {
        return $this
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Adding tags to contacts with a given ID
     * @param $idContact
     * @param $tagString
     * @return bool|Response
     */
    public function addTag($idContact, $tagString)
    {
        $data['tag'] = [$tagString];
        return $this
            ->setRequestPath('contact/' . $idContact . '/tag')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }
}