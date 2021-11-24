<?php

namespace Izyanza\Router;

class Router
{
    private $handlers;
    private const METHOD_GET = 'GET';
    private $notFoundHandler;
    private const METHOD_POST = 'POST';

    public function get($path, $handler) : void
    {
        $this->addHandlers(self::METHOD_GET,$path,$handler);
    }

    public function post($path, $handler) : void
    {
        $this->addHandlers(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandlers($method, $path, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function run()
    {
        $request_uri = parse_url($_SERVER["REQUEST_URI"]);
        $request_path = $request_uri['path'];
        $request_method = $_SERVER["REQUEST_METHOD"];

        $callback = null;
        foreach ($this->handlers as $handler) {
            if($handler['path'] === $request_path && $handler['method'] === $request_method) {
                $callback = $handler['handler'];
            }
        }

        if(!$callback) {
            header("HTTP/1.0 404 Not Found");
            if(!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}
