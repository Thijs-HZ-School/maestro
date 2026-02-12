<?php

namespace Framework;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class ResponseFactory
{
    private Environment $twig;

    public function __construct(bool $debugMode, string $viewsPath)
    {
        $loader = new FilesystemLoader($viewsPath);
        $this->twig = new Environment($loader, [
            'debug' => $debugMode
        ]);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function view(string $template, mixed $parameters = []): Response {
        return new Response($this->twig->render($template, $parameters));
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function notFound(): Response {
        return new Response($this->twig->render("404.html.twig"), null, 404);
    }
}