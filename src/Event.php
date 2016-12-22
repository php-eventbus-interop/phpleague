<?php

namespace EventIO\League;

use EventIO\InterOp\Event\BridgedEventInterface;
use EventIO\InterOp\Event\EventInterface;
use League\Event\AbstractEvent;
use League\Event\EmitterInterface;

/**
 * Class Event
 * @package EventIO\League
 */
class Event extends AbstractEvent implements BridgedEventInterface
{
    /**
     * @var EmitterInterface
     */
    protected $emitter;

    /**
     * @var EventInterface
     */
    protected $event;

    /**
     * Event constructor.
     * @param EventInterface $event
     */
    public function __construct(
        EventInterface $event,
        EmitterInterface $leagueEmitter
    ) {
        $this->event    = $event;
        $this->emitter  = $leagueEmitter;
    }

    /**
     * @return EventInterface
     */
    public function getWrappedEvent()
    {
        return $this->event;
    }

    /**
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->getWrappedEvent()->isPropagationStopped();
    }

    /**
     * @return EventInterface
     */
    public function stopPropagation()
    {
        $this->getWrappedEvent()->stopPropagation();
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getWrappedEvent()->name();
    }
}
