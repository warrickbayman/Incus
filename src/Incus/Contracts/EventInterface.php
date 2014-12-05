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
use Incus\Message;

/**
 * Interface EventInterface
 *
 * @package Incus\Contracts
 */
interface EventInterface
{
    /**
     * @param $mandrillEventJson
     */
    public function __construct($mandrillEventJson);


    /**
     * The raw webhook
     *
     * @return string
     */
    public function raw();


    /**
     * Event at
     *
     * @return Carbon
     */
    public function at();


    /**
     * The name of the event
     *
     * @return string
     */
    public function name();


    /**
     * Is this a send event?
     *
     * @return bool
     */
    public function send();


    /**
     * Is this a click event
     *
     * @return bool
     */
    public function click();


    /**
     * Is this a deferral event
     *
     * @return bool
     */
    public function deferral();


    /**
     * is this an open event
     *
     * @return bool
     */
    public function open();


    /**
     * Is this a hard bounce event
     *
     * @return bool
     */
    public function hardBounce();


    /**
     * Is this a soft bounce event
     *
     * @return bool
     */
    public function softBounce();


    /**
     * is this a reject event
     *
     * @return bool
     */
    public function reject();


    /**
     * is this a spam event
     *
     * @return bool
     */
    public function spam();


    /**
     * is this an unsubscribe event
     *
     * @return bool
     */
    public function unsub();


    /**
     * Is the message indexed?
     *
     * @return bool
     */
    public function indexed();


    /**
     * Message
     *
     * @return Message
     */
    public function message();


    /**
     * The URL clicked
     *
     * @return string
     */
    public function url();


    /**
     * The origin IP address for click and open events
     *
     * @return string
     */
    public function origin();


    /**
     * Location information
     *
     * @return Location
     */
    public function location();
}