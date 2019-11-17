<?php

namespace Console;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class Server
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function listen()
    {
        $console = $this->getConsoleApplication();

        exit($console->run());
    }

    /**
     * @return Application
     */
    protected function getConsoleApplication()
    {
        $console = new Application('test_runner');

        $cliConfig = $this->container->get('Config')['cli'];

        foreach ($cliConfig['commands'] as $command) {
            $console->add($this->container->get($command));
        }

        return $console;
    }
}
