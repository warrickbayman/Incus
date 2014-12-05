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
 * Interface LocationInterface
 *
 * @package Incus\Contracts
 */
interface LocationInterface
{
    /**
     * Abbreviated country
     *
     * @return string
     */
    public function countryShort();


    /**
     * Country
     *
     * @return string
     */
    public function country();


    /**
     * Region
     *
     * @return string
     */
    public function region();


    /**
     * City
     *
     * @return string
     */
    public function city();


    /**
     * Postal code
     *
     * @return string
     */
    public function postalCode();


    /**
     * Timezone
     *
     * @return string
     */
    public function timezone();


    /**
     * Latitude
     *
     * @return string
     */
    public function latitude();


    /**
     * Longitude
     *
     * @return string
     */
    public function longitude();
} 