<?php

namespace App\Model;

class GameResponse {

    /**
     * @var string
     */
    public $winner;
    /**
     * @var boolean
     */
    public $playerWins;
    /**
     * @var boolean
     */
    public $botWins;
    /**
     * @var boolean
     */
    public $tiedGame;
    /**
     * @var array
     */
    public $winnerPositions;
    /**
     * @var array
     */
    public $nextMove;

    public function __construct() {
        $this->winner = null;
        $this->botWins = false;
        $this->playerWins = false;
        $this->tiedGame = false;
        $this->nextMove = [];
        $this->winnerPositions = [];
    }
}