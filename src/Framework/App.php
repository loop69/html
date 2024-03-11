<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $containerDefifnitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefifnitionsPath) {

            $containerDefifnitions = include $containerDefifnitionsPath;

            $this->container->addDefinitions($containerDefifnitions);
        }
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, array $controller)
    {
        $this->router->add('GET', $path, $controller);
    }
}
