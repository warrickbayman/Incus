<?php
/**
 * Incus
 * 
 * @copyright   Copyright (c) 2014 Warrick Bayman.
 * @author		Warrick Bayman <me@warrickbayman.co.za>
 * @license     MIT License http://opensource.org/licenses/MIT
 * 
 */

use Incus\Event;
use Incus\Incus;
use Incus\Listener;

class ListenerTest extends TestCase
{
    /** @test */
    public function it_can_return_an_event_instance()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertInstanceOf('Incus\Event', $event);
            });
        });
    }

    /** @test */
    public function it_can_return_a_message_instance()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertInstanceOf('Incus\Message', $event->message());
            });
        });
    }

    /** @test */
    public function it_returns_a_carbon_instance_from_an_event()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertInstanceOf('Carbon\Carbon', $event->at());
            });
        });
    }

    /** @test */
    public function it_returns_a_carbon_instance_from_a_message()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertInstanceOf('Carbon\Carbon', $event->message()->at());
            });
        });
    }

    /** @test */
    public function it_returns_a_message_id()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertEquals('exampleaaaaaaaaaaaaaaaaaaaaaaaaa5', $event->message()->id());
            });
        });
    }

    /** @test */
    public function it_returns_email_addresses()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertEquals('example.webhook@mandrillapp.com', $event->message()->to());
                $this->assertEquals('example.sender@mandrillapp.com', $event->message()->from());
            });
        });
    }

    /** @test */
    public function it_can_return_an_array_of_tags()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->send(function(Event $event)
            {
                $this->assertTrue(is_array($event->message()->tags()));
            });
        });
    }

    /** @test */
    public function it_returns_a_tag_value()
    {

    }

    /** @test */
    /*public function it_can_return_an_array_of_metadata()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->send(function(Event $event)
            {
                $this->assertTrue(is_array($event->message()->metadata()));
            });
        });
    }*/

    /** @test */
    public function it_returns_metadata_as_an_object()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->send(function(Event $event)
            {
                $this->assertTrue(is_object($event->message()->metadata()->all()));
            });
        });
    }


    /** @test */
    public function it_returns_a_metadata_value()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->send(function(Event $event)
            {
                $this->assertEquals('111', $event->message()->metadata()->get('user_id'));
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
        Incus::listen(function(Listener $listener)
        {
            $listener->open(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_OPEN, $event->type());
            });
        });
    }

    /** @test */
    public function it_can_fire_a_deferral_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->deferral(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_DEFERRAL, $event->type());
            });
        });
    }

    /** @test */
    public function it_can_fire_a_soft_bounce_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->softBounce(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_SOFT_BOUNCE, $event->type());
            });
        });
    }

    /** @test */
    public function it_can_fire_a_hard_bounce_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->hardBounce(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_HARD_BOUNCE, $event->type());
            });
        });
    }

    /** @test */
    public function it_can_fire_a_spam_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->spam(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_SPAM, $event->type());
            });
        });
    }

    /** @test */
    public function it_can_fire_an_unsub_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->unsub(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_UNSUB, $event->type());
            });
        });
    }

    /** @test */
    public function it_can_fire_a_reject_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->reject(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_REJECT, $event->type());
            });
        });
    }
}