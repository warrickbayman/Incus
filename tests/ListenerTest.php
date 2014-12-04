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
    public function it_provides_some_basic_event_information()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event)
            {
                $this->assertInstanceOf('Carbon\Carbon', $event->at());
                $this->assertTrue($event->indexed());
                $this->assertEquals('click', $event->type());
            });
        });
    }

    /** @test */
    public function it_provides_some_basic_message_information()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->click(function(Event $event) {
                if ($event->indexed()) {
                    $message = $event->message();
                    $this->assertEquals('exampleaaaaaaaaaaaaaaaaaaaaaaaaa5', $message->id());
                    $this->assertInstanceOf('Carbon\Carbon', $message->at());
                    $this->assertEquals('example.webhook@mandrillapp.com', $message->to());
                    $this->assertEquals('example.sender@mandrillapp.com', $message->from());
                    $this->assertEquals('This an example webhook message', $message->subject());
                    $this->assertEquals('sent', $message->state());
                    $this->assertNull($message->subAccount());
                    $this->assertNull($message->template());
                    $this->assertTrue(is_array($message->tags()));
                }
            });
        });
    }


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
    public function it_can_fire_each_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->open(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_OPEN, $event->type());
            });

            $listener->deferral(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_DEFERRAL, $event->type());
            });

            $listener->softBounce(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_SOFT_BOUNCE, $event->type());
            });

            $listener->hardBounce(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_HARD_BOUNCE, $event->type());
            });

            $listener->spam(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_SPAM, $event->type());
            });

            $listener->unsub(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_UNSUB, $event->type());
            });

            $listener->reject(function(Event $event)
            {
                $this->assertEquals(Listener::EVENT_REJECT, $event->type());
            });
        });
    }


    /** @test */
    public function it_can_provide_information_about_a_bounce()
    {
        Incus::listen(function (Listener $listener)
        {
            $listener->softBounce(function(Event $event)
            {
                $this->assertEquals('mailbox_full', $event->message()->bounceDescription());
                $this->assertEquals('smtp;552 5.2.2 Over Quota', $event->message()->diag());
            });
        });
    }
}