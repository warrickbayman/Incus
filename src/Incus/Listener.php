<?php
/**
 * Incus
 * 
 * @copyright   Copyright (c) 2014 Warrick Bayman.
 * @author		Warrick Bayman <me@warrickbayman.co.za>
 * @license     MIT License http://opensource.org/licenses/MIT
 * 
 */

namespace Incus;

use Carbon\Carbon;

/**
 * Class Listener
 *
 * @package Incus
 */
class Listener implements Contracts\ListenerInterface
{
    /**
     * SEND
     */
    const EVENT_SEND = 'send';
    /**
     * DEFERRAL
     */
    const EVENT_DEFERRAL = 'deferral';
    /**
     * OPEN
     */
    const EVENT_OPEN = 'open';
    /**
     * CLICK
     */
    const EVENT_CLICK = 'click';
    /**
     * SOFT BOUNCE
     */
    const EVENT_SOFT_BOUNCE = 'soft_bounce';
    /**
     * HARD BOUNCE
     */
    const EVENT_HARD_BOUNCE = 'hard_bounce';
    /**
     * SPAM
     */
    const EVENT_SPAM = 'spam';
    /**
     * UNSUB
     */
    const EVENT_UNSUB = 'unsub';
    /**
     * REJECT
     */
    const EVENT_REJECT = 'reject';


    /**
     * @var array
     */
    private $eventStore;


    /**
     * Mandrill webhook listener
     *
     */
    public function __construct()
    {
        $this->eventStore = [];
        if (array_key_exists('mandrill_events', $_POST)) {

            $mandrillEvents = json_decode(stripslashes($_POST['mandrill_events']));

            foreach ($mandrillEvents as $mandrillEvent) {
                $newEvent = new \stdClass();

                $newEvent->raw = $mandrillEvent;

                $newEvent->at = Carbon::createFromTimestamp($newEvent->raw->ts);

                $newEvent->indexed = false;
                if (property_exists($newEvent->raw, 'msg') && is_object($newEvent->raw)) {
                    $newEvent->indexed = true;
                }

                /*if (property_exists($newEvent->raw, 'msg')) {
                    $newEvent->message->eventId = 10;
                }*/

                $this->eventStore[] = $newEvent;
            }
        }
    }


    public function getEvents()
    {
        return $this->eventStore;
    }


    /**
     * send event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function send(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_SEND) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * deferral event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function deferral(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_DEFERRAL) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * open event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function open(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_OPEN) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * click event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function click(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_CLICK) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * soft bounce event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function softBounce(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_SOFT_BOUNCE) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * hard bounce event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function hardBounce(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_HARD_BOUNCE) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * spam event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function spam(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_SPAM) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * unsub event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function unsub(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_UNSUB) {
                $callback($event);
            }
        }

        return $this;
    }


    /**
     * reject event handler
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function reject(Callable $callback)
    {
        foreach ($this->eventStore as $event) {
            if ($event->raw->event === Listener::EVENT_REJECT) {
                $callback($event);
            }
        }

        return $this;
    }
}