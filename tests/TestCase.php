<?php

use Symfony\Component\HttpFoundation\Session\Session;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function setUp() {
        parent::setUp();
        $sessionMockedMethods = [
            'set' => null,
            'get' => null,
            'put' => null,
            'has' => null,
            'forget' => null,
            'flash' => null,
        ];
        $sessionMock = Mockery::mock(Session::class, $sessionMockedMethods);

        $requestMockedMethods = [
            'ip' => '193.168.76.1', # Technoport's IP
            'getSession' => $sessionMock,
            'session' => $sessionMock,
            'has' => null,

            // Empty return that should give an empty HTTP_X_FORWARDED_PROTO
            'server' => null
        ];

        $requestMock = Mockery::mock(Request::class,
            $requestMockedMethods);

        $this->app->instance(Request::class, $requestMock);
    }

}
