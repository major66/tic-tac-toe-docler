<?php
// Routes

use App\Http\Controllers\GameController;
use App\Http\Controllers\IndexController;

$app->get('/', IndexController::class . ':index');
$app->post('/move', GameController::class . ':game');