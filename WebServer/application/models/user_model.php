<?php

class UserModel extends Model
{

    public $id, $username, $email, $password, $isAdmin;

    public function __construct($id, $username, $email, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function getData()
    {
        return $this->toArray();
    }

    public function __toString()
    {
        print_r($this->toArray());
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'isAdmin' => $this->isAdmin,
        ];
    }
}
