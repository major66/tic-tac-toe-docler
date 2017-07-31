<?php
// DIC configuration

use App\Services\Game\Helper\ChangePlayer;
use App\Services\Game\MinMax\GetMax;
use App\Services\Game\MinMax\GetMin;
use App\Services\Game\Helper\IsGameOver;
use App\Services\Game\MinMax\MinMax;
use App\Services\Game\Move\CountAllPossibleMoves;
use App\Services\Game\Move\GetAllPossibleMoves;
use App\Services\Game\Move\MakeMove;
use App\Services\Model\GetGameResponse;

$container = $app->getContainer();

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(
        new Monolog\Handler\StreamHandler($settings['path'],$settings['level'])
    );
    return $logger;
};

// Register component on container
$container['view'] = function ($container) {
    $settings = $container->get('settings')['twig'];
    $view = new \Slim\Views\Twig($settings['path'], [
        'cache' => $settings['cache']
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    return $view;
};

$container[IsGameOver::class] = new IsGameOver();

$container['Game'] = function ($c) {
    $isGameOver = $c->get(IsGameOver::class);
    $getMin = new GetMin();
    $getMax = new GetMax();
    $changePlayer = new ChangePlayer();
    $getAllPossibleMoves = new GetAllPossibleMoves();
    $minMax = new MinMax($isGameOver, $getMin, $getMax, $changePlayer);
    $makeAmove = new MakeMove($getAllPossibleMoves, $minMax);
    $changePlayer = new ChangePlayer();
    $getGameResponse = new GetGameResponse($isGameOver, $changePlayer);
    $counAllPossibleMoves = new CountAllPossibleMoves($getAllPossibleMoves);
    $logger = $c->get('logger');
    $validator = new \App\Services\Game\Validator\BoardValidator($logger);
    
    return new App\Services\Game\Game(
        $validator,
        $makeAmove,
        $getGameResponse,
        $counAllPossibleMoves
    );
};