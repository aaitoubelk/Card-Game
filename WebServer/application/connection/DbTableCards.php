<?php

include_once './application/models/user_model.php';

class DbTableCards
{
    private $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }


    public function getAll()
    {
        $res = $this->conn->query("select * from cards;");

        $res = $res->fetch_assoc();

        $resArr = [];

        foreach ($res as $row) {
            array_push($resArr, new
                UserModel(
                    $row['id'],
                    $row['name'],
                    $row['damage'],
                    $row['img'],
                    $row['type']
                ));
        }

        return $resArr;
    }
}
