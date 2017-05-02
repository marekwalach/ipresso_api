<?php

namespace iPresso\Model;

/**
 * Class MassContactAction
 * @package iPresso\Model
 */
class MassContactAction
{
    /**
     * @var ContactAction[]
     */
    private $actions;

    /**
     * @param $idContact
     * @param ContactAction $contactActivity
     * @return MassContactAction
     */
    public function addContactAction($idContact, ContactAction $contactActivity)
    {
        $this->actions[$idContact][] = $contactActivity;
        return $this;
    }

    /**
     * @return ContactAction[]
     */
    public function getContactActions()
    {
        return $this->actions;
    }
}