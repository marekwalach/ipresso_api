<?php

namespace Service;

use Model\Activity;

class ActivityService extends Service
{
    /**
     * Add new activity
     * @param Activity $activity
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Activity $activity)
    {
        return $this
            ->setRequestPath('activity')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($activity->getActivity())
            ->request();
    }
    
    
}