<?php

include 'DbTableUsers.php';
include 'DbTableCards.php';


class DatabaseContext
{
    private $conn;

    public $users;

    public $cards;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
        $this->users = new DbTableUsers($dbConn);
        $this->cards = new DbTableCards($dbConn);
    }
}
