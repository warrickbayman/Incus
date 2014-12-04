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


use Incus\Contracts\SimpleCollectionInterface;

class Metadata implements SimpleCollectionInterface
{
    private $metadata;


    /**
     * @param $message
     */
    function __construct($message)
    {
        $this->metadata = [];
        if (property_exists($message, 'metadata') and isset($message->metadata)) {
            $this->metadata = (Array)$message->metadata;
        }
    }


    /**
     * Returns an object of all the metadata keys
     *
     * @return stdClass
     */
    public function all()
    {
        return (Object)$this->metadata;
    }


    /**
     * Has metadata key
     *
     * @param string $key
     *
     * @return boolean
     */
    public function has($key)
    {
        if (array_key_exists($key, $this->metadata)) {
            return true;
        }
        return false;
    }


    /**
     * Get metadata value
     *
     * @param string $key
     *
     * @return string
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->metadata[$key];
        }
        return null;
    }
}