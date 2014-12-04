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


/**
 * Interface MetadataInterface
 *
 * @package Incus\Contracts
 */
interface SimpleCollectionInterface
{
    /**
     * Returns an object of all the metadata keys
     *
     * @return stdClass
     */
    public function all();


    /**
     * Has metadata key
     *
     * @param string $key
     *
     * @return boolean
     */
    public function has($key);


    /**
     * Get metadata value
     *
     * @param string $key
     *
     * @return string
     */
    public function get($key);
} 