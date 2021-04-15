<?php

include 'ControllerInterface.php';

class Controller implements ControllerInterface
{
    public $model;
    
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {
    }


    public function execute() { }   
}
