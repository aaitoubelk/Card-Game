<?php

include 'Room.php';

class ConnectionUser
{
    public $room;

    public $conn;

    public $username;

    public $userId;

    function __construct($conn, $room)
    {
        $this->conn = $conn;
        $this->room = $room;
    }

    function setUserData($username, $userId)
    {

        $this->username = $username;
        $this->userId = $userId;
    }

    function setRoom($room)
    {
        $this->room = $room;
    }


    function toJson()
    {
        return json_encode($this->toArray());
    }

    function toArray()
    {
        return [
            "username" => $this->username,
            "userId" => $this->userId,
        ];
    }

    function __toString()
    {
        return $this->toJson() . " [$this->conn]";
    }
}
