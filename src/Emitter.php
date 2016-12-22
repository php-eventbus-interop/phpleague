<?php

namespace EventIO\League;

use EventIO\InterOp\Emitter\EmitterInterface;
use EventIO\InterOp\Emitter\EmitterTrait;
use EventIO\InterOp\Event\EventInterface;
use EventIO\InterOp\Event\NamedEvent;
use EventIO\InterOp\ListenerAcceptorInterface;
use EventIO\InterOp\Listener\ListenerInterface;
use League\Event\EmitterInterface as LeagueEmitter;

/**
 * Class Emitter
 * @package EventIO\League
 */
class Emitter implements EmitterInterface, ListenerAcceptorInterface
{
    /**
     * @var LeagueEmitter
     */
    private $emitter;

    /**
     * Proxy emit() to either emitEvent() or emitName()
     */
    use EmitterTrait;

    /**
     * Emitter constructor.
     * @param LeagueEmitter $emitter
     */
    public function __construct(LeagueEmitter $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @param EventInterface $event The event triggered
     * @return mixed
     */
    public function emitEvent(EventInterface $event)
    {
        $this->emitter->emit(new Event($event, $this->emitter));
    }

    /**
     * @param string $event The event name to listen for
     * @return mixed
     */
    public function emitName($event)
    {
        $this->emitEvent(NamedEvent::named($event));
    }

    /**
     * @param string $eventName The name of the event to listen for
     * @param callable|ListenerInterface $listener A listener or callable
     * @param int $priority Used to prioritise listeners for the same event
     * @return mixed
     */
    public function addListener(
        $eventName,
        $listener,
        $priority = self::PRIORITY_NORMAL
    )
    {
        $this->emitter->addListener($eventName, new Listener($listener), $priority);
    }
}
