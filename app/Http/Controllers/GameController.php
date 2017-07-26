<?php

namespace App\Http\Controllers;

use App\Services\Game\Game;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GameController extends Controller {
    
    /**
     * @var Game
     */
    private $game;

    public function game(
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $gameInformations = json_decode($request->getBody());
        $this->game = $this->getService($request, 'Game');
        $bestMove = $this->game->game($gameInformations);
        return json_encode($bestMove);
    }
}