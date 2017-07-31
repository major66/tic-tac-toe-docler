<?php

namespace Test\App\Services\Game\Helper;

use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\Helper\IsGameOver;
use App\Services\Game\MinMax\GetMax;
use App\Services\Game\MinMax\GetMin;
use App\Services\Game\MinMax\MinMax;
use PHPUnit\Framework\TestCase;

class MinMaxTest extends TestCase {

    public function testMinMax() {
        $boards = $this->getMinMaxDataProvider();
        $bestMoveFirstCase = $this->getMinMax()->determineBestMove(
            $boards[0]['boardState'],
            $boards[0]['playerUnit']
        );
        $bestMoveSecondCase = $this->getMinMax()->determineBestMove(
            $boards[1]['boardState'],
            $boards[1]['playerUnit']
        );
        $this->assertEquals(0, $bestMoveFirstCase['cells'][0]);
        $this->assertEquals(0, $bestMoveFirstCase['cells'][1]);
        $this->assertEquals(0, $bestMoveSecondCase['cells'][0]);
        $this->assertEquals(1, $bestMoveSecondCase['cells'][1]);

    }

    /**
     * @return array
     */
    private function getMinMaxDataProvider() {
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
}