<?php

namespace Service;

use Model\Action;

class ActionService extends Service
{
    /**
     * Add new actions
     * @param Action $action
     * @return bool|Response
     * @throws \Exception
     */
    public function addAction(Action $action)
    {
        return $this
            ->setRequestPath('action')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($action->getAction())
            ->request();
    }
}