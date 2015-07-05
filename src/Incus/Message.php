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
use Incus\Contracts\MessageInterface;

class Message implements MessageInterface
{
    private $message;


    private function getProperty($property, $default = null)
    {
        if (property_exists($this->message, $property) && isset($this->message->{$property})) {
            return $this->message->{$property};
        }
        return $default;
    }


    /**
     * Message
     *
     * @param $event Event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->message = json_decode($event->raw())->msg;
    }

    /**
     * Message ID
     *
     * @return string
     */
    public function id()
    {
        return $this->getProperty('_id');
    }

    /**
     * Message sent at
     *
     * @return Carbon
     */
    public function at()
    {
        if ($this->getProperty('ts')) {
            return Carbon::createFromTimestamp($this->getProperty('ts'));
        }
        return null;
    }

    /**
     * Recipient email address
     *
     * @return string
     */
    public function to()
    {
        return $this->getProperty('email');
    }

    /**
     * Sender email address
     *
     * @return string
     */
    public function from()
    {
        return $this->getProperty('sender');
    }

    /**
     * Message subject
     *
     * @return string
     */
    public function subject()
    {
        return $this->getProperty('subject');
    }

    /**
     * Array of tags
     *
     * @return array
     */
    public function tags()
    {
        $tags = $this->getProperty('tags');
        if ($tags) {
            return (Array)$tags;
        }
        return null;
    }

    /**
     * Metadata
     *
     * @return Metadata
     */
    public function metadata()
    {
        return new Metadata($this->message);
    }

    /**
     * Message state
     *
     * @return string
     */
    public function state()
    {
        return $this->getProperty('state');
    }

    /**
     * Message was sent with this sub account
     *
     * @return string
     */
    public function subAccount()
    {
        return $this->getProperty('subaccount');
    }

    /**
     * Bounced SMTP response message
     *
     * @return string|null
     */
    public function diag()
    {
        return $this->getProperty('diag');
    }

    /**
     * Short description of the bounce reason
     *
     * @return string
     */
    public function bounceDescription()
    {
        return $this->getProperty('bounce_description');
    }

    /**
     * The template slug
     *
     * @return string|null
     */
    public function template()
    {
        return $this->getProperty('template');
    }
}
