<?php

namespace Test\App\Services\Game\Move;

use App\Services\Game\Move\CountAllPossibleMoves;
use App\Services\Game\Move\GetAllPossibleMoves;
use PHPUnit\Framework\TestCase;

class CountAllPossibleMovesTest extends TestCase {

    public function testCountAllPossibleMoves() {
        $boards = $this->getCountAllPossibleMovesTestDataProvider();
        $countThreeMoves = $this->getCountAllPossibleMovesTest()
            ->countAllPossibleMoves($boards[0]);
        $countOneMove = $this->getCountAllPossibleMovesTest()
            ->countAllPossibleMoves($boards[1]);
        $countHeigthMoves = $this->getCountAllPossibleMovesTest()
            ->countAllPossibleMoves($boards[2]);
        $this->assertEquals(3, $countThreeMoves);
        $this->assertEquals(1, $countOneMove);
        $this->assertEquals(8, $countHeigthMoves);
    }

    /**
     * @return CountAllPossibleMoves
     */
    private function getCountAllPossibleMovesTest() {
        $class = new CountAllPossibleMoves($this->getGetAllPossibleMoves());
        return $class;
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
    private function getCountAllPossibleMovesTestDataProvider() {
        $boards[] = [
            ["O","","O"],
            ["O","","X"],
            ["X","","O"]
        ];
        $boards[] = [
            ["O","","O"],
            ["O","X","X"],
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