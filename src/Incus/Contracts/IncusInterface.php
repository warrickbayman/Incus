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

interface IncusInterface
{

    /**
     * @param callable $callback
     *
     * @return Listener
     */
    public static function listen(Callable $callback);
}
