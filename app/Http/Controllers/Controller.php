<?php

namespace App\Http\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Container;

class Controller {

    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function render(ResponseInterface $response, $file, $args = []) {
       return  $this->container->view->render($response, $file, $args);
    }
    
    public function getService(RequestInterface $request, $service) {
        return $this->container->get($service);
    }
}