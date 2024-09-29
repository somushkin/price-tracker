<?php

namespace App\Http;

class Request
{
    private ?string $prefix = null;

    private ?string $controller = null;

    private ?string $action = null;

    private ?string $arg = null;

    private $prefixes = [
        'api'
    ];

    public function __construct(
        private ?string $requestUri = null,
        private ?string $requestMethod = null,
        private ?array  $data = null,
    )
    {

    }

    public function getData()
    {
        return $this->data;
    }

    public function handle(): void
    {
        $this->parseURI();

        if (class_exists($this->controller) && method_exists($this->controller, $this->action)) {
            $controller = new $this->controller($this);
            $controller->{$this->action}($this->arg);
        }
    }

    private function parseURI(): void
    {
        $parts = explode('/', $this->requestUri);
        array_shift($parts);

        if (in_array($parts[0], $this->prefixes)) {
            $this->prefix = $parts[0];
            $controller = !empty($parts[1]) ? ucfirst($parts[1]) . 'Controller' : 'IndexController';
            $this->action = !empty($parts[2]) ? ucfirst($parts[2]) . 'Action' : 'indexAction';
            $this->controller = 'App\Controllers\\' . $this->prefix . '\\' . $controller;
        } else {
            $controller = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'IndexController';
            $this->controller = 'App\Controllers\\' . $controller;
            $this->action = !empty($parts[1]) ? ucfirst($parts[1]) . 'Action' : 'indexAction';

            if (!method_exists($this->controller, $this->action)) {
                $this->arg = $parts[1];
                $this->action = 'indexAction';
            }
        }
    }
}