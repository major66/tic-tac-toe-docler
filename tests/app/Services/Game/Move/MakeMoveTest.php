<?php

namespace Test\App\Services\Game\Move;

use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\MinMax\GetMax;
use App\Services\Game\MinMax\GetMin;
use App\Services\Game\Helper\IsGameOver;
use App\Services\Game\MinMax\MinMax;
use App\Services\Game\Move\GetAllPossibleMoves;
use App\Services\Game\Move\MakeMove;
use PHPUnit\Framework\TestCase;

class MakeMoveTest extends TestCase {

    public function testMakeMove() {
        $boards = $this->getMakeMoveDataProvider();
        // Something went wrong.
        // problem was a conflict between my phpversion and the phpunit version
        // I will solve this problem soon and update this file.
    }

    /**
     * @return MakeMove
     */
    private function getMakeMove() {
        $getAllPossibleMoves = $this->getGetAllPossibleMoves();
        $getMinMax = $this->getMinMax();
        $class = new MakeMove(
            $getAllPossibleMoves,
            $getMinMax
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
     * @return MinMax
     */
    private function getMinMax() {
        $class = new MinMax(
            $this->getIsGameOver(),
            $this->getGetMin(),
            $this->getGetMax(),
            $this->getChangePlayer()
        );
        return $class;
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