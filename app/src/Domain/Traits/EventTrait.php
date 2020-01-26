<?php

declare(strict_types=1);

namespace App\Domain\Traits;

trait EventTrait
{

    /**
     * @var object[]
     */
    private $events = [];

    /**
     * @param object $event
     */
    private function registerEvent($event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return object[]
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}
