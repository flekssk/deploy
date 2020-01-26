<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExampleCommand
 * @package App\Command
 */
class ExampleCommand extends Command
{
    protected static $defaultName = 'app:test-command';

    /**
     * Конфигурация вызова команды импорта
     */
    protected function configure()
    {
        $this
            ->setDescription('Тестовая команда')
            ->addArgument('id', InputArgument::REQUIRED, 'Идентификатор')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Название');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = new ConsoleLogger($output);
        $logger->debug(sprintf('Start command %s', static::getDefaultName()), [$input->getArguments(), $input->getOptions()]);


        $logger->debug(sprintf('Stop command %s', static::getDefaultName()), [$input->getArguments(), $input->getOptions()]);
    }
}
