<?php

namespace Service;

use Model\Contact;
use iPresso;
use Service;

class ContactService extends iPresso implements Service
{
    /**
     * Adding new contact
     * @param Contact $contact
     * @return bool|iPresso\Response
     * @throws \Exception
     */
    public function add(Contact $contact)
    {
        $post_data = [];
        $post_data['contact'][] = $contact->getContact();
        return $this
            ->setRequestPath('contact')
            ->setRequestType(iPresso::REQUEST_METHOD_POST)
            ->setPostData($post_data)
            ->request();
    }

    /**
     * Edition of a contact with a given ID number
     * @param $id_contact
     * @param Contact $contact
     * @return bool|iPresso\Response
     * @throws \Exception
     */
    public function edit($id_contact, Contact $contact)
    {
        return $this
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(iPresso::REQUEST_METHOD_PUT)
            ->setPostData(['contact' => $contact->getContact()])
            ->request();
    }

    /**
     * Delete contact
     * @param $id_contact
     * @return bool|iPresso\Response
     */
    public function delete($id_contact)
    {
        return $this
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(iPresso::REQUEST_METHOD_DELETE)
            ->request();
    }

    public function get($id_contact)
    {
        return $this
            ->setRequestPath('contact/' . $id_contact)
            ->setRequestType(iPresso::REQUEST_METHOD_GET)
            ->request();
    }


}