<?php

namespace App\Services\Game\Helper;

class IsGameOver {

    /**
     * Determine the state of the game
     * 
     * if there is a player with one full row -> return winner player
     * if there is a player with one full column -> return winner player
     * if there is a player with one full diagonal -> return winner player
     * if there is still moves to do -> return false
     * if the game is a tie -> return null
     * 
     * @param $board
     * @return bool|null
     */
    public function isGameOver($board)  {
        $gameBoardCount = count($board);
        //ROW
        for ($i = 0; $i < $gameBoardCount; $i++) {
            if ($board[$i][0] !== '' &&
                ($board[$i][0] === $board[$i][1] &&
                    $board[$i][0] == $board[$i][2])) {
                return $board[$i][0];
            }
        }

        $gameBoardCount = count($board[0]);
        //FULL COLUMN
        for ($i = 0; $i < $gameBoardCount; $i++) {
            if ($board[0][$i]!= '' &&
                ($board[0][$i] == $board[1][$i] &&
                    $board[0][$i] == $board[2][$i])) {
                return $board[0][$i];
            }
        }

        //DIAGONAL
        if ($board[0][0] !== '' &&
            ($board[0][0] === $board[1][1] &&
                $board[0][0] === $board[2][2])) {
            return $board[0][0];
        }

        //diagolnal bottom left to right
        if ($board[2][0]!== '' &&
            ($board[2][0] === $board[1][1] &&
                $board[2][0] === $board[0][2])) {
            return $board[2][0];
        }

        for ($iterator = 0; $iterator < count($board); $iterator++) {
            for ($subIterator = 0; $subIterator < count($board[$iterator]); $subIterator++) {
                if($board[$iterator][$subIterator] === '') {
                    return false;
                }
            }
        }
        return null;
    }
}