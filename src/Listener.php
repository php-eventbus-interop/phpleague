<?php

namespace EventIO\League;

use EventIO\InterOp\Listener\BridgedListenerInterface;
use EventIO\InterOp\Listener\ListenerInterface;
use League\Event\EventInterface;
use League\Event\ListenerInterface as LeagueListener;

class Listener implements LeagueListener, BridgedListenerInterface
{
    /**
     * @var ListenerInterface
     */
    private $listener;

    /**
     * Listener constructor.
     * @param ListenerInterface $listener
     */
    public function __construct(ListenerInterface $listener)
    {
        $this->listener = $listener;
    }

    /**
     * Handle an event.
     *
     * @param EventInterface $event
     *
     * @return void
     */
    public function handle(EventInterface $event)
    {
        // TODO: Implement handle() method.
    }

    /**
     * Check whether the listener is the given parameter.
     *
     * @param mixed $listener
     *
     * @return bool
     */
    public function isListener($listener)
    {
        // TODO: Implement isListener() method.
    }

    /**
     * Return the wrapped InterOp Listener.
     * @return ListenerInterface
     */
    public function getWrappedListener()
    {
        // TODO: Implement getWrappedListener() method.
    }
}
