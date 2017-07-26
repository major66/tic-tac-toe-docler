<?php

namespace Test\App\Services\Game\Move;

use App\Services\Game\Move\GetAllPossibleMoves;
use PHPUnit\Framework\TestCase;

class GetAllPossibleMovesTest extends TestCase {

    public function testGetAllPossibleMoves() {
        $boards = $this->getGetAllPossibleMovesTestDataProvider();
        $firstBoard = $this->getGetAllPossibleMoves()
            ->GetAllPossibleMoves($boards[0]);
        $secondBoard = $this->getGetAllPossibleMoves()
            ->GetAllPossibleMoves($boards[1]);
        $thirdBoard = $this->getGetAllPossibleMoves()
            ->GetAllPossibleMoves($boards[2]);
        
        $this->assertContains([0,1], $firstBoard);
        $this->assertNotContains([0,0], $firstBoard);
        $this->assertContains([1,1], $secondBoard);
        $this->assertNotContains([0,0], $secondBoard);
        $this->assertContains([2,2], $thirdBoard);
        $this->assertNotContains([2,0], $thirdBoard);
    }

    /**
     * @return GetAllPossibleMoves
     */
    private function getGetAllPossibleMoves() {
        $class = new GetAllPossibleMoves();
        return $class;
    }

    /**
     * @return array
     */
    private function getGetAllPossibleMovesTestDataProvider() {
        $boards[] = [
            ["O","","O"],
            ["O","","X"],
            ["X","","O"]
        ];
        $boards[] = [
            ["O","","O"],
            ["O","","X"],
            ["X","O","O"]
        ];
        $boards[] = [
            ["","",""],
            ["","",""],
            ["X","",""]
        ];
        return $boards;
    }
}