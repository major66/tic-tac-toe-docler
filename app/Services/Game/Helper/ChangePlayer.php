<?php

namespace App\Services\Game\Helper;

class ChangePlayer {

    /**
     * @param $name
     * @return string
     */
    public function changePlayer($name) {
        return $name === 'X' ? 'O' : 'X';
    }
}