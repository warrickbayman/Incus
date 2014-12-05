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


use Incus\Contracts\LocationInterface;

class Location implements LocationInterface
{
    /**
     * @var Event
     */
    private $event;


    /**
     * @param Event $event
     */
    function __construct(Event $event)
    {
        $this->event = $event;
        $this->location = json_decode($event->raw())->location;
    }


    /**
     * Abbreviated country
     *
     * @return string
     */
    public function countryShort()
    {
        return $this->location->country_short;
    }


    /**
     * Country
     *
     * @return string
     */
    public function country()
    {
        return $this->location->country_long;
    }


    /**
     * Region
     *
     * @return string
     */
    public function region()
    {
        return $this->location->region;
    }


    /**
     * City
     *
     * @return string
     */
    public function city()
    {
        return $this->location->city;
    }


    /**
     * Postal code
     *
     * @return string
     */
    public function postalCode()
    {
        return $this->location->postal_code;
    }


    /**
     * Timezone
     *
     * @return string
     */
    public function timezone()
    {
        return $this->location->timezone;
    }


    /**
     * Latitude
     *
     * @return string
     */
    public function latitude()
    {
        return $this->location->latitude;
    }


    /**
     * Longitude
     *
     * @return string
     */
    public function longitude()
    {
        return $this->location->longitude;
    }
}