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
use SebastianBergmann\Exporter\Exception;

/**
 * Class Event
 *
 * @package Incus
 */
class Event implements EventInterface
{
    /**
     * @var
     */
    private $raw;
    private $decoded;

    /**
     * @param $mandrillEventJson
     */
    public function __construct($mandrillEventJson)
    {
        $this->raw = $mandrillEventJson;
        $this->decoded = json_decode($this->raw);
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

    public function at()
    {
        return Carbon::createFromTimestamp($this->decoded->ts);
    }

    public function type()
    {
        return $this->decoded->event;
    }

    public function indexed()
    {
        if (property_exists($this->decoded, 'msg') and isset($this->decoded->msg)) {
            return true;
        }
        return false;
    }

    public function message()
    {
        if ($this->indexed()) {
            return new Message($this);
        }
        return null;
    }

    public function __get($method)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        throw new Exception('No such property');
    }
}