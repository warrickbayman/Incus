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
    public function it_can_receive_a_mandrill_webhook()
    {
        Incus::listen(function(Listener $listener)
        {
            $listener
                ->send(function ($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'SEND at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->click(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'CLICK at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . ' from ' . $event->raw->ip . "\n";
                })
                ->deferral(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'DEFERRAL at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->hardBounce(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'HARD BOUNCE at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->open(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'OPEN at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->reject(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'REJECT as ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->softBounce(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'SOFT BOUNCE at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->spam(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'SPAM at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                })
                ->unsub(function($event)
                {
                    $this->assertInstanceOf('StdClass', $event);
                    $this->assertObjectHasAttribute('raw', $event);
                    echo 'UNSUB at ' . \Carbon\Carbon::createFromTimestamp($event->raw->ts)->format('l d F Y') . "\n";
                });
        });
    }
} 