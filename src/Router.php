<?php

namespace Framework;

class Router
{
    /* @var array<Route> */
    public array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function dispatch(Request $request): Response {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                return new Response($route->return);
            }
        }

        return new Response(body: "404: Page not found", responseCode: 404);
    }

    public function addRoute(string $method, string $path, string $return): void {
        $this->routes[] = new Route($method, $path, $return);
    }
}