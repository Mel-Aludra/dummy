<?php
abstract class Controller
{

    protected $data = [];

    public function addData($key, $data)
    {
        $this->data[$key] = $data;
    }

    public function getData()
    {
        return $this->data;
    }

}