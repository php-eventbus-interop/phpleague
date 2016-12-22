<?php

namespace spec\EventIO\League;

use EventIO\InterOp\Event\BridgedEventInterface;
use EventIO\InterOp\Event\EventInterface;
use EventIO\InterOp\Listener\BridgedListenerInterface;
use EventIO\InterOp\Listener\ListenerInterface;
use League\Event\EmitterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmitterSpec extends ObjectBehavior
{
    function let(EmitterInterface $emitter)
    {
        $this->beConstructedWith($emitter);
    }

    function it_emits_league_events(
        EventInterface $event,
        $emitter
    )
    {
        $emitter->emit(Argument::type(BridgedEventInterface::class))->shouldBeCalled();
        $this->emit($event);
    }

    function it_emits_a_named_event($emitter) {
        $event = 'league.bridge';
        $emitter->emit(Argument::type(BridgedEventInterface::class))->shouldBeCalled();
        $this->emit($event);
    }

    function it_adds_listeners(
        ListenerInterface $listener,
        EmitterInterface $emitter
    ) {
        $eventName = 'foo.bar';
        $emitter->addListener(
            $eventName,
            Argument::type(BridgedListenerInterface::class),
            Argument::type('int')
        )->shouldBeCalled();
        $this->addListener($eventName, $listener);
    }
}
