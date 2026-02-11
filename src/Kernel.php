<?php

namespace Framework;

use phpDocumentor\GraphViz\Exception;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $responseFactory = new ResponseFactory();

        $this->router = new Router($responseFactory);
        $this->container = new ServiceContainer();

        $this->container->set(ResponseFactory::class, $responseFactory);
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }
}