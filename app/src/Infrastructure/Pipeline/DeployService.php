<?php

namespace App\Infrastructure\Pipeline;

class DeployService
{
    /**
     * @param Pipeline $pipeline
     *
     * @return bool
     */
    public function deploy(Pipeline $pipeline): bool
    {
        $result = true;

        /**
         * @var CommandInterface $command
         */
        foreach ($pipeline->getCommands() as $command) {
            $command->run();
        }

        return $result;
    }
}
