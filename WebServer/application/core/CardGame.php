<?php

include_once './CardGame.php';

class CardGame extends Game
{
    public $isOver;

    public $players;

    function __construct($players)
    {
        $this->players = $players;
    }

    function start()
    {
        
    }
}
