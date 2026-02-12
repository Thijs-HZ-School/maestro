<?php

namespace Framework;

use \Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    private ConfigManager $configManager;

    /**
     * @throws Exception
     */
    public function __construct(array $config)
    {
        $this->configManager = new ConfigManager($config);
        $debugMode = $this->configManager->get('APP_ENV') != 'production';

        $this->container = new ServiceContainer();

        $responseFactory = new ResponseFactory($debugMode, $this->configManager->get('VIEWS_PATH'));
        $this->container->set(ResponseFactory::class, $responseFactory);

        $this->router = new Router($responseFactory);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
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