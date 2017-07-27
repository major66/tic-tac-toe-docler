<?php

namespace App\Services\Game\Move;

use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\Helper\GetMax;
use App\Services\Game\Helper\GetMin;
use App\Services\Game\Helper\IsGameOver;

class MakeMove implements MoveInterface {

    /**
     * @var IsGameOver
     */
    private $isGameOver;

    /**
     * @var GetMax
     */
    private $getMax;

    /**
     * @var GetMin
     */
    private $getMin;

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

    /**
     * @var GetAllPossibleMoves
     */
    private $getAllPossibleMoves;

    public function __construct(
        IsGameOver $isGameOver,
        GetMax $getMax,
        GetMin $getMin,
        ChangePlayer $changePlayer,
        GetAllPossibleMoves $getAllPossibleMoves
    ) {
        $this->isGameOver = $isGameOver;
        $this->getMax = $getMax;
        $this->getMin = $getMin;
        $this->changePlayer = $changePlayer;
        $this->getAllPossibleMoves = $getAllPossibleMoves;
    }

    /**
     * This is the primary function for determine the best move.
     * This function determine if there is more thant one move to do.
     * if this is the case then the minMax is called to determine the best move.
     *
     * @param array $boardState
     * @param string $playerUnit
     * @return array
     */
    public function makeMove(
        array $boardState,
        string $playerUnit = "X"
    ) : array {

        $allPossibleMoves =
            $this->getAllPossibleMoves->GetAllPossibleMoves($boardState);
        if (count($allPossibleMoves) === 1) {
            return [
                'cells' => $allPossibleMoves[0],
                'player' => $playerUnit
            ];
        }
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
        if ($isGameOver === false) {
            $values = [];
            for ($iterator = 0; $iterator < 3; $iterator++) {
                for ($subIterator = 0; $subIterator < 3; $subIterator++) {
                    $gridCopy = $grid;
                    if ($gridCopy[$iterator][$subIterator] !== '') {
                        continue;
                    }
                    $gridCopy[$iterator][$subIterator] = $player;
                    $value['cost'] = $this->minMax($gridCopy, $depth + 1, ($player === $this->playerToken) ? $this->computerToken : $this->playerToken);
                    $value['depth'] = $depth;
                    $value['cells'][0] = $iterator;
                    $value['cells'][1] = $subIterator;
                    array_push($values, $value);
                    unset($value);
                }
            }
            if ($player === $this->computerToken) {
                $max = $this->getMax->getMax($values);
                if ($depth === 0) {
                    return $max;
                } else {
                    return $max['cost'];
                }
            } else {
                $min = $this->getMin->getMin($values);
                if ($depth === 0) {
                    return $min['cells'];
                } else {
                    return $min['cost'];
                }
            }
        } elseif ($isGameOver == null) {
            return 0;
        } elseif ($isGameOver === $this->playerToken) {
            return $depth - 10;
        } elseif ($isGameOver === $this->computerToken) {
            return 10 - $depth;
        }
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
            return;
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