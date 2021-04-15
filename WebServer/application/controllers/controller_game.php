<?php

include './application/connection/DatabaseConnection.php';

class Controller_Game extends Controller
{
    private $db;

    function __construct()
    {
        parent::__construct();
        $this->db = new DatabaseConnection("127.0.0.1", "card_game", "kmospan", "password");
    }


    function action_index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/main/login');
            return;
        }

        $this->view->render('connection_view.php', 'template_view.php');
    }


    function action_play()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/main/login');
            return;
        }

        if (!isset($_GET['roomId'])) {
            header("Location: " . 'http://' . $_SERVER['HTTP_HOST'] . '/game');
            return;
        }
        
        // $this->view->viewBag['roomId'] = $_GET['roomId'];

        $this->view->render('play_view.php', 'template_view.php');
    }
}
