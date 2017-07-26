<?php

namespace Test\App\Services\Game\Helper;

use App\Services\Game\Helper\IsGameOver;
use PHPUnit\Framework\TestCase;

class IsGameOverTest extends TestCase{

    public function testIsGameOver() {
        $allTypeOfBoards = $this->getIsGameOverDataProvider();
        $tie = $this->getIsGameOverTest()->isGameOver($allTypeOfBoards['tie']);
        $notFinishYet = $this->getIsGameOverTest()
            ->isGameOver($allTypeOfBoards['notFinishYet']);
        $column = $this->getIsGameOverTest()
            ->isGameOver($allTypeOfBoards['column']);
        $row = $this->getIsGameOverTest()
            ->isGameOver($allTypeOfBoards['row']);
        $diagonalLeft = $this->getIsGameOverTest()
            ->isGameOver($allTypeOfBoards['diagonalLeft']);
        $diagonalRight = $this->getIsGameOverTest()
            ->isGameOver($allTypeOfBoards['diagonalRight']);
        
        $this->assertEquals(null, $tie);
        $this->assertEquals(false, $notFinishYet);
        $this->assertEquals('O', $column);
        $this->assertEquals('X', $row);
        $this->assertEquals('X', $diagonalLeft);
        $this->assertEquals('O', $diagonalRight);
    }

    /**
     * @return IsGameOver
     */
    private function getIsGameOverTest() {
        $class = new IsGameOver();
        return $class;
    }

    /**
     * @return array
     */
    private function getIsGameOverDataProvider() {
        $board['notFinishYet'] = [
                ["O","X","O"],
                ["X","",""],
                ["X","O",""]
        ];

        $board['tie'] = [
                ["O","X","O"],
                ["O","X","X"],
                ["X","O","O"]
        ];
        $board['column'] = [
                ["O","X","O"],
                ["X","X","O"],
                ["X","O","O"]
        ];
        $board['row'] = [
            ["O","X","O"],
            ["X","X","X"],
            ["X","O","O"]
        ];
        $board['diagonalLeft'] = [
            ["X","X","O"],
            ["O","X",""],
            ["X","","X"]
        ];
        $board['diagonalRight'] = [
            ["X","X","O"],
            ["O","O","O"],
            ["O","O","X"]
        ];
        return $board;
    }
}