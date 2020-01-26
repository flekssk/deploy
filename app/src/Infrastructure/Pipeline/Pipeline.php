<?php

namespace App\Infrastructure\Pipeline;

class Pipeline
{
    /**
     * @var CommandCollection
     */
    protected $commands;
    /**
     * @var CommandCollection
     */
    private $completedCommand;

    public function __construct()
    {
        $this->commands = new CommandCollection();
        $this->completedCommand = new CommandCollection();
    }

    public function addCommand(CommandInterface $command)
    {
        $this->commands->pushCommand($command);
    }

    /**
     * @return CommandCollection
     */
    public function getCommands(): CommandCollection
    {
        return $this->commands;
    }

    public function completeCommand(CommandInterface $command)
    {
        $this->completedCommand->pushCommand($command);
    }

    /**
     * @return CommandCollection
     */
    public function getCompletedCommand(): CommandCollection
    {
        return $this->completedCommand;
    }
}
