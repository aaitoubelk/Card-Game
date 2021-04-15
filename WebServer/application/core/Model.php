<?php
abstract class Model
{
    public $db;

    protected function __construct()
    {
    }

    public abstract function getData();
}
