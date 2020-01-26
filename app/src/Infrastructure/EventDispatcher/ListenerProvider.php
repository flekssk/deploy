<?php

declare(strict_types=1);

namespace App\Infrastructure\EventDispatcher;

use App\Domain\EventDispatcher\ListenerProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListenerProvider implements ListenerProviderInterface
{

    /**
     * @var EventDispatcherInterface
     */
    private $symfonyEventDispatcher;

    public function __construct(EventDispatcherInterface $symfonyEventDispatcher)
    {
        $this->symfonyEventDispatcher = $symfonyEventDispatcher;
    }

    /**
     * @param object $event
     * @return iterable[callable]
     */
    public function getListenersForEvent(object $event): iterable
    {
        return $this->symfonyEventDispatcher->getListeners(get_class($event));
    }
}
