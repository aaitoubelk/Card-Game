<?php

include_once './application/models/user_model.php';

class DbTableUsers
{
    private $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    public function insert($user)
    {
        if (!$this->contains('username', $user->username)) {
            $res = $this->conn->query("insert ignore into users values(null, \"$user->username\", \"$user->email\", \"$user->password\", false);");

            $user->id = $this->conn->insert_id;
        }
    }

    public function contains($par, $value)
    {
        $sql = "SELECT * FROM users WHERE $par=\"$value\";";
        $res = $this->conn->query($sql);
        return ($res === FALSE) ? false : $res->num_rows !== 0;
    }

    public function update($user)
    {
        if ($this->contains('username', $user->username)) {
            $this->conn->query(
                "
                update users
                set username=\"$user->username\"
                    email=\"$user->email\"
                    password=\"$user->password\"
                    isAdmin=\"$user->isAdmin\"
                where id=$user->id;"
            );
        }
    }



    public function getUserByUsername($username)
    {
        return $this->getUserBy('username', $username);
    }

    public function getUserByEmail($email)
    {
        return $this->getUserBy('email', $email);
    }

    private function getUserBy($parName, $value)
    {
        $res = $this->conn->query("select * from users where $parName=\"$value\" limit 1;");

        if (mysqli_num_rows($res) == 0) return null;

        $res = $res->fetch_assoc();

        return new UserModel(
            $res['id'],
            $res['username'],
            $res['email'],
            $res['password'],
            $res['isAdmin']
        );
    }
}
