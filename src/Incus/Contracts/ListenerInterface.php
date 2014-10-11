<?php

namespace Incus\Contracts;

use Incus\Listener;

/**
 * Incus
 * 
 * @copyright   Copyright (c) 2014 Warrick Bayman.
 * @author		Warrick Bayman <me@warrickbayman.co.za>
 * @license     MIT License http://opensource.org/licenses/MIT
 * 
 */

interface ListenerInterface
{
    /**
     * SEND event
     * @param callable $callback
     *
     * @return Listener
     */
    public function send(Callable $callback);

    /**
     * DEFERRAL event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function deferral(Callable $callback);

    /**
     * OPEN event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function open(Callable $callback);

    /**
     * CLICK event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function click(Callable $callback);

    /**
     * SOFT_BOUNCE event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function softBounce(Callable $callback);

    /**
     * HARD_BOUNCE event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function hardBounce(Callable $callback);

    /**
     * SPAM event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function spam(Callable $callback);

    /**
     * UNSUB event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function unsub(Callable $callback);

    /**
     * REJECT event
     *
     * @param callable $callback
     *
     * @return Listener
     */
    public function reject(Callable $callback);
}