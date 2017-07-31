<?php

namespace App\Services\Game\Move;

use App\Services\Game\MinMax\MinMax;

class MakeMove implements MoveInterface {

    /**
     * @var GetAllPossibleMoves
     */
    private $getAllPossibleMoves;

    /**
     * @var MinMax
     */
    private $minMax;

    public function __construct(
        GetAllPossibleMoves $getAllPossibleMoves,
        MinMax $minMax
    ) {
        $this->getAllPossibleMoves = $getAllPossibleMoves;
        $this->minMax = $minMax;
    }

    /**
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
        $bestMove = $this->minMax->determineBestMove($boardState, $playerUnit);
        return $bestMove;
    }
}