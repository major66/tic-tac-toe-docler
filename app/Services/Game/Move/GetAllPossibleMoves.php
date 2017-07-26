<?php

namespace App\Services\Game\Move;

class GetAllPossibleMoves {

    /**
     * 
     * Determine all the possible moves on the board.
     * Move that are not played yet.
     * 
     * @param $board
     * @return array|null
     */
    public function GetAllPossibleMoves($board) {
        $possibleMouvements = null;
        foreach ($board as $line => $row) {
            foreach ($row as $key => $column) {
                if (empty($column)) {
                    $possibleMouvements[] = [$line, $key];
                }
            }
        }
        return $possibleMouvements;
    }
}