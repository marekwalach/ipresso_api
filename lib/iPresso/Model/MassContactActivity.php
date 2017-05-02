<?php

namespace iPresso\Model;

/**
 * Class MassContactActivity
 * @package iPresso\Model
 */
class MassContactActivity
{
    /**
     * @var ContactActivity[]
     */
    private $activities;

    /**
     * @param $idContact
     * @param ContactActivity $contactActivity
     * @return MassContactActivity
     */
    public function addContactActivity($idContact, ContactActivity $contactActivity)
    {
        $this->activities[$idContact][] = $contactActivity;
        return $this;
    }

    /**
     * @return ContactActivity[]
     */
    public function getContactActivities()
    {
        return $this->activities;
    }
}