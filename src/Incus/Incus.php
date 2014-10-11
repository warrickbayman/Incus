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

/**
 * Class Incus
 *
 * @package Incus
 */
class Incus implements Contracts\IncusInterface
{
    /**
     * Listen for a Mandril webhook post
     *
     * @param Callable   $callback
     *
     * @return \Incus\Listener
     */
    public static function listen(Callable $callback)
    {
        $listener = new Listener();
        $callback($listener);

        return $listener;
    }
}