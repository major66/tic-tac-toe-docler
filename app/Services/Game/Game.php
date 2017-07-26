<?php

namespace App\Services\Game;

use App\Services\Game\Move\CountAllPossibleMoves;
use App\Services\Game\Move\MakeMove;
use App\Services\Game\Validator\BoardValidator;
use App\Services\Model\GetGameResponse;

class Game {

    /**
     * @var BoardValidator
     */
    private $boardValidator;

    /**
     * @var MakeMove
     */
    private $makeMove;

    /**
     * @var GetGameResponse
     */
    private $getGameResponse;

    /**
     * @var CountAllPossibleMoves
     */
    private $countAllPossibleMoves;

    public function __construct(
        BoardValidator $boardValidator,
        MakeMove $makeMove,
        GetGameResponse $getGameResponse,
        CountAllPossibleMoves $countAllPossibleMoves
    ) {
        $this->boardValidator = $boardValidator;
        $this->makeMove = $makeMove;
        $this->getGameResponse = $getGameResponse;
        $this->countAllPossibleMoves = $countAllPossibleMoves;
    }
    
    public function game($gameInformations) {
        $board = $gameInformations->boardState;
        $player = $gameInformations->playerUnit;
        $this->boardValidator->boardValidator($board);

        $countpossibleMoves = $this->countAllPossibleMoves
            ->countAllPossibleMoves($board);
        if ($countpossibleMoves > 0) {
            $moveInformations = $this->makeMove->makeMove($board, $player);
            $moveInformations['botUnit'] = $gameInformations->botUnit;
            $gameResponse = $this->getGameResponse->getGameResponse(
                $board,
                $moveInformations
            );
        } else {
            return [
                'error' => true,
                'Type' => 'Zero possible move'
            ];
        }
        return $gameResponse;
    }
}