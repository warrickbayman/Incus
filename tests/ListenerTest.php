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
    public function it_returns_a_carbon_instance()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->send(function($event)
            {
                $this->assertInstanceOf('Carbon\Carbon', $event->at);
            });
        });
    }


    /** @test */
    public function it_can_check_if_a_message_has_been_indexed()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener->send(function($event)
            {
                $this->assertTrue($event->indexed);
            });
        });
    }


    /** @test */
    public function it_returns_an_array_of_events()
    {
        $events = Incus::listen();

        $this->assertTrue(is_array($events));
        $this->assertInstanceOf('StdClass', $events[0]);
        $this->assertInstanceOf('Carbon\Carbon', $events[0]->at);
    }


    /** @test */
    public function it_can_fire_an_event_handler()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener
                ->send(function ($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'SEND at ' . $event->at . "\n";
                })
                ->click(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'CLICK at ' . $event->at . ' from ' . $event->raw->ip . "\n";
                })
                ->deferral(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'DEFERRAL at ' . $event->at . "\n";
                })
                ->hardBounce(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'HARD BOUNCE at ' . $event->at . "\n";
                })
                ->open(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'OPEN at ' . $event->at . "\n";
                })
                ->reject(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'REJECT as ' . $event->at . "\n";
                })
                ->softBounce(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'SOFT BOUNCE at ' . $event->at . "\n";
                })
                ->spam(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'SPAM at ' . $event->at . "\n";
                })
                ->unsub(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'UNSUB at ' . $event->at . "\n";
                });
        });
    }
} 