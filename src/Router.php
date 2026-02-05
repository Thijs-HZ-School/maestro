<?php

namespace Framework;

class Router
{
    /** @var array<Route> */
    public array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function dispatch(Request $request): Response {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                $callback = $route->callback;
                return $callback();
            }
        }

        return new Response(body: "404: Page not found", responseCode: 404);
    }

    public function addRoute(string $method, string $path, callable $callback): void {
        $this->routes[] = new Route($method, $path, $callback);
    }
}