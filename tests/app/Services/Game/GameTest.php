<?php

namespace Test\App\Services\Game;

use App\Services\Game\Game;
use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\Helper\GetMax;
use App\Services\Game\Helper\GetMin;
use App\Services\Game\Helper\IsGameOver;
use App\Services\Game\Move\CountAllPossibleMoves;
use App\Services\Game\Move\GetAllPossibleMoves;
use App\Services\Game\Move\MakeMove;
use App\Services\Game\Validator\BoardValidator;
use App\Services\Model\GetGameResponse;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {

    public function testGame() {
        $boards = $this->getGameDataProvider();
        //$firstGame = $this->getGame()->game($boards[0]);
    }

    /**
     * @return Game
     */
    private function getGame() {
        $class = new Game(
            $this->getBoardValidator(),
            $this->getMakeMove(),
            $this->getGameResponse(),
            $this->getCountAllPossibleMoves()
        );
        return $class;
    }

    /**
     * @return array
     */
    private function getGameDataProvider() {
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
     * @return Logger
     */
    private function getLogger() {
        $class = Logger::class;
        return $class;
    }

    /**
     * @return BoardValidator
     */
    private function getBoardValidator() {
        $class = new BoardValidator($this->getLogger());
        return $class;
    }

    /**\
     * @return MakeMove
     */
    private function getMakeMove() {
        $class = new MakeMove(
            $this->getIsGameOver(),
            $this->getGetMax(),
            $this->getGetMin(),
            $this->getChangePlayer(),
            $this->getGetAllPossibleMoves()
        );
        return $class;
    }

    /**
     * @return GetGameResponse
     */
    private function getGameResponse() {
        $class = new GetGameResponse(
            $this->getIsGameOver(),
            $this->getChangePlayer()
        );
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
     * @return GetAllPossibleMoves
     */
    private function getGetAllPossibleMoves() {
        $class = new GetAllPossibleMoves();
        return $class;
    }

    /**
     * @return CountAllPossibleMoves
     */
    private function getCountAllPossibleMoves() {
        $class = new CountAllPossibleMoves($this->getGetAllPossibleMoves());
        return $class;
    }
}