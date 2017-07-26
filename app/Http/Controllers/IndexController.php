<?php

namespace App\Http\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class IndexController extends Controller {
    
    public function index(
        RequestInterface $request,
        ResponseInterface $response
    ) {
        return $this->render($response, 'index.html.twig');
    }
}