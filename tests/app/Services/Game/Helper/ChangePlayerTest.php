<?php

namespace Test\App\Services\Game\Helper;

use App\Services\Game\Helper\ChangePlayer;
use PHPUnit\Framework\TestCase;

class ChangePlayerTest extends TestCase {
    
    public function testChangePlayer() {
        $player = 'X';
        $player = $this->getChangePlayerTest()->changePlayer($player);
        $this->assertContains('O', $player);
    }

    /**
     * @return ChangePlayer
     */
    private function getChangePlayerTest() {
        $class = new ChangePlayer();
        return $class;
    }
}