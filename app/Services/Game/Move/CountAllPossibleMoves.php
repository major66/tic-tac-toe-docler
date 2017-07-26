<?php

namespace App\Services\Game\Move;

class CountAllPossibleMoves {

    /**
     * @var GetAllPossibleMoves
     */
    private $getAllPossibleMoves;
    
    public function __construct(GetAllPossibleMoves $getAllPossibleMoves) {
        $this->getAllPossibleMoves = $getAllPossibleMoves;
    }

    /**
     * 
     * Determine the number of move
     * @param $board
     * @return int
     */
    public function countAllPossibleMoves($board) {
        $countAllPossibleMoves = count(
            $this->getAllPossibleMoves->GetAllPossibleMoves($board)
        );
        return $countAllPossibleMoves;
    }
}