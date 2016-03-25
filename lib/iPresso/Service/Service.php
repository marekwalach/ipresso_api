<?php

interface Service
{
    /**
     * @param $data
     * @return mixed
     */
    public function add();

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function edit($id, $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @return mixed
     */
    public function get($id);

}