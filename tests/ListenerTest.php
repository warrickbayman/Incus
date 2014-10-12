<?php
/**
 * Incus
 * 
 * @copyright   Copyright (c) 2014 Warrick Bayman.
 * @author		Warrick Bayman <me@warrickbayman.co.za>
 * @license     MIT License http://opensource.org/licenses/MIT
 * 
 */

use Incus\Incus;
use Incus\Listener;

class ListenerTest extends TestCase
{
    /** @test */
    public function it_can_return_an_event_instance()
    {
        Incus::listen(function($listener)
        {
            $listener->click(function($event)
            {
                $this->assertInstanceOf('Incus\Event', $event);
            });
        });
    }

    /** @test */
    public function it_can_return_a_message_instance()
    {
        Incus::listen(function($listener)
        {
            $listener->click(function($event)
            {
                $this->assertInstanceOf('Incus\Message', $event->message);
            });
        });
    }

    /** @test */
    public function it_returns_a_carbon_instance_from_an_event()
    {
        Incus::listen(function($listener)
        {
            $listener->click(function($event)
            {
                $this->assertInstanceOf('Carbon\Carbon', $event->at);
            });
        });
    }

    /** @test */
    public function it_returns_a_carbon_instance_from_a_message()
    {
        Incus::listen(function($listener)
        {
            $listener->click(function($event)
            {
                $this->assertInstanceOf('Carbon\Carbon', $event->message->at);
            });
        });
    }

    /** @test */
    public function it_can_return_an_array_of_tags()
    {
        Incus::listen(function($listener)
        {
            $listener->send(function($event)
            {
                $this->assertTrue(is_array($event->message->tags));
            });
        });
    }

    /** @test */
    public function it_can_return_an_array_of_metadata()
    {
        Incus::listen(function($listener)
        {
            $listener->send(function($event)
            {
                $this->assertTrue(is_array($event->message->metadata));
            });
        });
    }

    /** @test */
    public function it_returns_an_array_of_events()
    {
        $events = Incus::listen();

        $this->assertTrue(is_array($events));
        $this->assertInstanceOf('Incus\Event', $events[0]);
    }

    /** @test */
    public function it_can_fire_an_open_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->open(function($event)
            {
                $this->assertEquals(Listener::EVENT_OPEN, $event->type);
            });
        });
    }

    /** @test */
    public function it_can_fire_a_deferral_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->deferral(function($event)
            {
                $this->assertEquals(Listener::EVENT_DEFERRAL, $event->type);
            });
        });
    }

    /** @test */
    public function it_can_fire_a_soft_bounce_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->softBounce(function($event)
            {
                $this->assertEquals(Listener::EVENT_SOFT_BOUNCE, $event->type);
            });
        });
    }

    /** @test */
    public function it_can_fire_a_hard_bounce_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->hardBounce(function($event)
            {
                $this->assertEquals(Listener::EVENT_HARD_BOUNCE, $event->type);
            });
        });
    }

    /** @test */
    public function it_can_fire_a_spam_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->spam(function($event)
            {
                $this->assertEquals(Listener::EVENT_SPAM, $event->type);
            });
        });
    }

    /** @test */
    public function it_can_fire_an_unsub_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->unsub(function($event)
            {
                $this->assertEquals(Listener::EVENT_UNSUB, $event->type);
            });
        });
    }

    /** @test */
    public function it_can_fire_a_reject_event_handler()
    {
        Incus::listen(function($listener)
        {
            $listener->reject(function($event)
            {
                $this->assertEquals(Listener::EVENT_REJECT, $event->type);
            });
        });
    }
}