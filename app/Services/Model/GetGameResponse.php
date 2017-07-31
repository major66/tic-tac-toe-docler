<?php

namespace App\Services\Model;

use App\Model\GameResponse;
use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\Helper\IsGameOver;

class GetGameResponse
{

    /**
     * @var IsGameOver
     */
    private $isGameOver;

    /**
     * @var ChangePlayer
     */
    private $changePlayer;

    public function __construct(
        IsGameOver $isGameOver,
        ChangePlayer $changePlayer
    ) {
        $this->isGameOver = $isGameOver;
        $this->changePlayer = $changePlayer;

    }

    public function getGameResponse($board, $gameInformations) {
        $gameResponse = new GameResponse();
        if ($this->isSpecialCase($gameInformations)) {
            return
                $this->getSpecialCaseResponse($gameResponse, $gameInformations);
        }
        $newBoard = $this->getBoardWithNextMove(
            $board,
            $gameInformations['cells'],
            $gameInformations['player']
            );
        $isGameOver = $this->isGameOver->isGameOver($newBoard);

        $gameResponse->tiedGame = $this->isTieGame($isGameOver);
        $gameResponse->winner = $this->isWinner($isGameOver);
        $gameResponse->playerWins = $this->isPlayerWin(
            $isGameOver,
            $gameInformations['player']
        );
        $gameResponse->botWins = $this->isBotWin(
            $isGameOver,
            $gameInformations['player']
        );
        $gameResponse->nextMove[] = $gameInformations['cells'][0];
        $gameResponse->nextMove[] = $gameInformations['cells'][1];
        $gameResponse->nextMove[] = $gameInformations['player'];
        $gameResponse->winnerPositions = [];
        return $gameResponse;
    }

    private function getBoardWithNextMove($board, $move, $player) {
        $newBoard = $board;
        $newBoard[$move[0]][$move[1]] = $player;
        return $newBoard;
    }

    private function isTieGame($isGameOver) {
        if ($isGameOver === null) {
            return true;
        }
        return false;
    }

    private function isWinner($isGameOver) {
        if ($isGameOver === 'O' || $isGameOver === 'X') {
            return $isGameOver;
        }
        return null;
    }
    
    private function isPlayerWin($isGameOver, $computerName) {
        $player = $this->changePlayer->changePlayer($computerName);
        if ($isGameOver === $player) {
            return true;
        }
        return false;
    }

    private function isBotWin($isGameOver, $computerName) {
        if ($isGameOver === $computerName) {
            return true;
        }
        return false;
    }


    /**
     * Function for handle specific case.
     * I didn't have time to solve this.
     * So i made it work for now
     *
     * @param $gameInformations
     * @return bool
     */
    private function isSpecialCase($gameInformations) {
        if ($gameInformations['botUnit'] === $gameInformations['pLayer']) {
            return true;
        }
        return false;
    }

    private function getSpecialCaseResponse($gameResponse, $gameInformations) {
        $gameResponse->tiedGame = false;
        $gameResponse->winner = null;
        $gameResponse->playerWins = false;
        $gameResponse->botWins = false;
        $gameResponse->nextMove[] = $gameInformations['cells'][0];
        $gameResponse->nextMove[] = $gameInformations['cells'][1];
        $gameResponse->nextMove[] = $gameInformations['player'];
        $gameResponse->winnerPositions = [];
        return $gameResponse;
    }
}