<?php

namespace Test\App\Services\Game\Move;

use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\Helper\GetMax;
use App\Services\Game\Helper\GetMin;
use App\Services\Game\Helper\IsGameOver;
use App\Services\Game\Move\GetAllPossibleMoves;
use App\Services\Game\Move\MakeMove;
use PHPUnit\Framework\TestCase;

class MakeMoveTest extends TestCase {

    public function testMakeMove() {
        $boards = $this->getMakeMoveDataProvider();
        //$boardone = $this->getMakeMove()
        //->makeMove($boards[0]['boardState'], $boards[0]['playerUnit']);
        /*
        $boardTwo = $this->getMakeMove()
            ->makeMove($boards[1]['boardState'], $boards[1]['playerUnit']);
        $boardThree = $this->getMakeMove()
            ->makeMove($boards[2]['boardState'], $boards[2]['playerUnit']);*/
    }

    /**
     * @return MakeMove
     */
    private function getMakeMove() {
        $isGameOver = $this->getIsGameOver();
        $getMax = $this->getGetMax();
        $getMin = $this->getGetMin();
        $changePlayer = $this->getChangePlayer();
        $getAllPossibleMoves = $this->getGetAllPossibleMoves();
        $class = new MakeMove(
            $isGameOver,
            $getMax,
            $getMin,
            $changePlayer,
            $getAllPossibleMoves
        );
        return $class;
    }

    private function getMakeMoveDataProvider() {
        $boards[] = [
            "playerUnit" => "X",
            "botUnit" => 'X',
            "boardState" => [
                ["","X","O"],
                ["X","O",""],
                ["X","O",""]
            ]
        ];
        $boards[] = [
            "playerUnit" => "X",
            "botUnit" => 'X',
            "boardState" => [
                ["","","O"],
                ["","O",""],
                ["X","O","X"]
            ]
        ];
        return $boards;
    }

    /**
     * @return IsGameOver
     */
    private function getIsGameOver() {
        $class = new IsGameOver();
        return $class;
    }

    /**
     * @return GetMax
     */
    private function getGetMax() {
        $class = new GetMax();
        return $class;
    }

    /**
     * @return GetMin
     */
    private function getGetMin() {
        $class = new GetMin();
        return $class;
    }

    /**
     * @return ChangePlayer
     */
    private function getChangePlayer() {
        $class = new ChangePlayer();
        return $class;
    }

    /**
     * @return GetAllPossibleMoves
     */
    private function getGetAllPossibleMoves() {
        $class = new GetAllPossibleMoves();
        return $class;
    }
}