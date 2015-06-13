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
     * The event type
     *
     * @return mixed
     */
    public function type()
    {
        return $this->decoded->event;
    }


    /**
     * Has the event been indexed?
     *
     * @return bool
     */
    public function indexed()
    {
        if (property_exists($this->decoded, 'msg') && isset($this->decoded->msg)) {
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
}
