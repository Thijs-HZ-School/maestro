<?php

namespace Framework;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Router
{
    /** @var array<Route> */
    public array $routes;

    public ResponseFactory $responseFactory;

    public function __construct(responseFactory $responseFactory)
    {
        $this->routes = [];
        $this->responseFactory = $responseFactory;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function dispatch(Request $request): Response {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                $callback = $route->callback;
                return $callback();
            }
        }

        return $this->responseFactory->notFound();
    }

    public function addRoute(string $method, string $path, callable $callback): void {
        $this->routes[] = new Route($method, $path, $callback);
    }
}