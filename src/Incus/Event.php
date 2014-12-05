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
use Incus\Contracts\EventInterface;

/**
 * Class Event
 *
 * @package Incus
 */
class Event implements EventInterface
{
    /**
     * @var string
     */
    private $raw;
    /**
     * @var mixed
     */
    private $decoded;

    /**
     * @param $mandrillEventJson
     */
    public function __construct($mandrillEventJson)
    {
        $this->raw = $mandrillEventJson;
        $this->decoded = json_decode($this->raw());
    }

    /**
     * RAW json encoded event object
     *
     * @return string
     */
    public function raw()
    {
        return $this->raw;
    }


    /**
     * Time of the event
     *
     * @return Carbon
     */
    public function at()
    {
        return Carbon::createFromTimestamp($this->decoded->ts);
    }


    /**
     * The event name
     *
     * @return mixed
     */
    public function name()
    {
        return $this->decoded->event;
    }


    /**
     * Is this a send event?
     *
     * @return bool
     */
    public function send()
    {
        return $this->name() == 'send';
    }


    /**
     * Is this a click event
     *
     * @return bool
     */
    public function click()
    {
        return $this->name() == 'click';
    }


    /**
     * Is this a deferral event
     *
     * @return bool
     */
    public function deferral()
    {
        return $this->name() == 'deferral';
    }


    /**
     * is this an open event
     *
     * @return bool
     */
    public function open()
    {
        return $this->name() == 'open';
    }


    /**
     * Is this a hard bounce event
     *
     * @return bool
     */
    public function hardBounce()
    {
        return $this->name() == 'hard_bounce';
    }


    /**
     * Is this a soft bounce event
     *
     * @return bool
     */
    public function softBounce()
    {
        return $this->name() == 'soft_bounce';
    }


    /**
     * is this a reject event
     *
     * @return bool
     */
    public function reject()
    {
        return $this->name() == 'reject';
    }


    /**
     * is this a spam event
     *
     * @return bool
     */
    public function spam()
    {
        return $this->name() == 'spam';
    }


    /**
     * is this an unsubscribe event
     *
     * @return bool
     */
    public function unsub()
    {
        return $this->name() == 'unsub';
    }


    /**
     * Has the event been indexed?
     *
     * @return bool
     */
    public function indexed()
    {
        if (property_exists($this->decoded, 'msg') and isset($this->decoded->msg)) {
            return true;
        }
        return false;
    }


    /**
     * Message
     *
     * @return Message|null
     */
    public function message()
    {
        if ($this->indexed()) {
            return new Message($this);
        }
        return null;
    }


    /**
     * The URL clicked
     *
     * @return string
     */
    public function url()
    {
        if (property_exists('url', $this->decoded) and isset($this->decoded->url)) {
            return $this->decoded->url;
        }

        return null;
    }


    /**
     * The origin IP address for click and open events
     *
     * @return string
     */
    public function origin()
    {
        if (property_exists('ip', $this->decided) and isset($this->decoded->ip)) {
            return $this->decoded->ip;
        }
        return null;
    }


    /**
     * Location information
     *
     * @return Location
     */
    public function location()
    {
        return new Location($this);
    }
}