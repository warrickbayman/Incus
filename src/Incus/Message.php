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
    /**
     * @var Event
     */
    private $event;
    private $message;

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
        return $this->message->_id;
    }

    /**
     * Message sent at
     *
     * @return Carbon
     */
    public function at()
    {
        return Carbon::createFromTimestamp($this->message->ts);
    }

    /**
     * Recipient email address
     *
     * @return string
     */
    public function to()
    {
        return $this->message->email;
    }

    /**
     * Sender email address
     *
     * @return string
     */
    public function from()
    {
        return $this->message->sender;
    }

    /**
     * Message subject
     *
     * @return string
     */
    public function subject()
    {
        return $this->message->subject;
    }

    /**
     * Array of tags
     *
     * @return array
     */
    public function tags()
    {
        if (property_exists($this->message, 'tags') and isset($this->message->tags)) {

            return (Array)$this->message->tags;
        }
        return null;
    }

    /**
     * Metadata
     *
     * @return array
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
        return $this->message->state;
    }

    /**
     * Message was sent with this sub account
     *
     * @return string
     */
    public function subAccount()
    {
        return $this->message->subaccount;
    }

    /**
     * Bounced SMTP response message
     *
     * @return string|null
     */
    public function diag()
    {
        if (property_exists($this->message, 'diag') and isset($this->message->diag)) {
            return $this->message->diag;
        }
        return null;
    }

    /**
     * Short description of the bounce reason
     *
     * @return string
     */
    public function bounceDescription()
    {
        if (property_exists($this->message, 'bounce_description') and isset($this->message->bounce_description)) {
            return $this->message->bounce_description;
        }
        return null;
    }

    /**
     * The template slug
     *
     * @return string|null
     */
    public function template()
    {
        if (property_exists($this->message, 'template') and isset($this->message->template)) {
            return $this->message->template;
        }
        return null;
    }
}
