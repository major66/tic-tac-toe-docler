<?php

namespace App\Services\Game\MinMax;

use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\MinMax\GetMax;
use App\Services\Game\MinMax\GetMin;
use App\Services\Game\Helper\IsGameOver;

class MinMax {

    /**
     * @var IsGameOver
     */
    private $isGameOver;

    /**
     * @var GetMin
     */
    private $getMin;

    /**
     * @var GetMax
     */
    private $getMax;

    /**
     * @var ChangePlayer
     */
    private $changePlayer;

    /**
     * @var string
     */
    private $playerToken;

    /**
     * @var string
     */
    private $computerToken;

    public function __construct(
        IsGameOver $isGameOver,
        GetMin $getMin,
        GetMax $getMax,
        ChangePlayer $changePlayer
    ) {
        $this->isGameOver = $isGameOver;
        $this->getMin = $getMin;
        $this->getMax = $getMax;
        $this->changePlayer = $changePlayer;
    }

    /**
     *
     * This is the primary function for determine the best move.
     * This function determine if there is more thant one move to do.
     * if this is the case then the minMax is called to determine the best move.
     *
     * @param $boardState
     * @param $playerUnit
     * @return array
     */
    public function determineBestMove($boardState, $playerUnit) {
        $playerUnit = $this->changePlayer->changePlayer($playerUnit);
        $this->setComputerToken($playerUnit);
        $bestMove = $this->minMax($boardState, 0, $playerUnit);
        $bestMove['player'] = $this->computerToken;
        return $bestMove;
    }

    /**
     *
     * This function use recursivity and the minMax algorithm.
     *
     * https://fr.wikipedia.org/wiki/Algorithme_minimax
     *
     * This function need to be modified(refactor -> too many line) :(
     *
     *
     * @param $grid
     * @param $depth
     * @param $player
     * @return int
     */
    private function minMax($grid, $depth, $player) {
        $isGameOver = $this->isGameOver->isGameOver($grid);
        $cost = null;
        if ($isGameOver === false) {
            $MovesArray = [];
            for ($iterator = 0; $iterator < 3; $iterator++) {
                for ($subIterator = 0; $subIterator < 3; $subIterator++) {
                    $gridCopy = $grid;
                    if ($gridCopy[$iterator][$subIterator] !== '') {
                        continue;
                    }
                    $gridCopy[$iterator][$subIterator] = $player;
                    $move['cost'] = $this->minMax(
                        $gridCopy,
                        $depth + 1,
                        $this->changePlayer->changePlayer($player)
                    );
                    $move['depth'] = $depth;
                    $move['cells'][0] = $iterator;
                    $move['cells'][1] = $subIterator;
                    array_push($MovesArray, $move);
                    unset($move);
                }
            }
            if ($player === $this->computerToken) {
                return $this->determineMaxReturningValue($MovesArray, $depth);
            } else {
               return $this->determineMinReturningValue($MovesArray, $depth);
            }
        } else {
            $cost = $this->determineCost($isGameOver, $depth);
        }
        return $cost;
    }

    private function determineMaxReturningValue($MovesArray, $depth) {
        $max = $this->getMax->getMax($MovesArray);
        $returnValue = null;

        if ($depth === 0) {
            $returnValue = $max;
        } else {
            $returnValue = $max['cost'];
        }
        return $returnValue;
    }

    private function determineMinReturningValue($MovesArray, $depth) {
        $min = $this->getMin->getMin($MovesArray);
        $returnValue = null;

        if ($depth === 0) {
            $returnValue = $min['cells'];
        } else {
            $returnValue = $min['cost'];
        }
        return $returnValue;
    }

    private function determineCost($isGameOverValue, $depth) {
        $cost = null;

        if ($isGameOverValue == null) {
                $cost = 0;
        } else if ($isGameOverValue === $this->playerToken) {
                $cost = $depth - 10;
        } else if ($isGameOverValue === $this->computerToken) {
                $cost = 10 - $depth;
        }
        return $cost;
    }

    /**
     *
     * set the computer token and in the same time the player token.
     *
     * @param $value
     */
    private function setComputerToken($value) {
        $this->computerToken = $value;
        if ($this->computerToken === 'X') {
            $this->setPlayerToken('O');
        }
        $this->setPlayerToken('X');
    }

    /**
     * @param $value
     */
    private function setPlayerToken($value) {
        $this->playerToken = $value;
    }
}