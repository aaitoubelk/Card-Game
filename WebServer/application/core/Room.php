<?php


class Room
{

    public $users = [];

    public $game = null;

    function __construct()
    {
    }

    function addUser($user)
    {
        if (count($this->users) >= 2) return;

        array_push($this->users, $user);
    }

    function setGame($game)
    {
        $this->game = $game;
    }

    function removeUser($userConn)
    {
        if (!$this->containsUserConn($userConn)) return;

        for ($i = 0; $i < count($this->users); $i++) {
            if ($this->users[$i]->conn == $userConn) {
                unset($this->users[$i]);
                break;
            }
        }
        $this->users = array_values($this->users);
    }

    function containsUserConn($userConn)
    {
        foreach ($this->users as $user) {
            if ($user->conn == $userConn)
                return true;
        }
        return false;
    }


    function toJson()
    {
        return json_encode($this->toArray());
    }

    function toArray()
    {
        $encUsers =  [];

        foreach ($this->users as $user) {
            $encUsers[] = $user->toJson();
        }

        return [
            "users" => $encUsers,
        ];
    }

    function __toString()
    {
        return $this->toJson();
    }
}
