<?php

namespace App\Infrastructure\Pipeline;

use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandBuilder
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $commandAlias
     *
     * @return CommandInterface|object
     */
    public function build(string $commandAlias)
    {
        return $this->container->get($commandAlias);
    }
}
