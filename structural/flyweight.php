<?php

namespace DesignPattern\Structural\Flyweight;

class Player
{
    public $color;
}

class PlayerFactory
{
    public static $players;

    public static function getPlayer($type)
    {
        if (!isset(self::$players[$type])) {
            self::$players[$type] = new Player();
        }
        return self::$players[$type];

    }
}

$player1 = PlayerFactory::getPlayer('red');
$player1->color = 'red';

$player2 = PlayerFactory::getPlayer('red');
$player2->color = 'yellow';

$player3 = PlayerFactory::getPlayer('blue');
$player3->color = 'blue';

$player4 = PlayerFactory::getPlayer('blue');
$player4->color = 'green';

var_dump($player1);
var_dump($player2);
var_dump($player3);
var_dump($player4);
