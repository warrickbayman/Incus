<?php
/**
 * Incus
 * 
 * @copyright   Copyright (c) 2014 Warrick Bayman.
 * @author		Warrick Bayman <me@warrickbayman.co.za>
 * @license     MIT License http://opensource.org/licenses/MIT
 * 
 */

namespace Incus\Contracts;


use Carbon\Carbon;
use Incus\Event;

/**
 * Interface MessageInterface
 *
 * @package Incus\Contracts
 */
interface MessageInterface
{
    /**
     * Message
     *
     * @param $event
     */
    public function __construct(Event $event);

    /**
     * Message ID
     *
     * @return string
     */
    public function id();

    /**
     * Message sent at
     *
     * @return Carbon
     */
    public function at();

    /**
     * Recipient email address
     *
     * @return string
     */
    public function to();

    /**
     * Sender email address
     *
     * @return string
     */
    public function from();

    /**
     * Message subject
     *
     * @return string
     */
    public function subject();

    /**
     * Array of tags
     *
     * @return array
     */
    public function tags();

    /**
     * Array of metadata
     *
     * @return array
     */
    public function metadata();

    /**
     * Message state
     *
     * @return string
     */
    public function state();

    /**
     * Message was sent with this sub account
     *
     * @return string
     */
    public function subAccount();

    /**
     * Bounced SMTP response message
     *
     * @return string|null
     */
    public function diag();

    /**
     * Short description of the bounce reason
     *
     * @return string
     */
    public function bounceDescription();

    /**
     * The template slug
     *
     * @return string|null
     */
    public function template();
}
