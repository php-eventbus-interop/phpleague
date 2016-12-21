<?php

namespace spec\EventIO\League;

use EventIO\InterOp\EventInterface;
use League\Event\EmitterInterface;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    function let(EventInterface $event, EmitterInterface $emitter)
    {
        $this->beConstructedWith($event, $emitter);
    }

    function it_allows_access_to_the_wrapped_event($event)
    {
        $this->getWrappedEvent()->shouldReturn($event);
    }

    function it_stops_propogation($event)
    {
        $event->isPropagationStopped()->willReturn(false, true);
        $this->isPropagationStopped()->shouldReturn(false);

        $event->stopPropagation()->shouldBeCalled();
        $this->stopPropagation();
        $this->isPropagationStopped()->shouldReturn(true);
    }

    function it_has_the_emitter($emitter)
    {
        $this->getEmitter()->shouldReturn($emitter);
    }
}
