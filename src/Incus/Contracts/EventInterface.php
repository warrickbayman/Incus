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


interface EventInterface
{
    public function __construct($mandrillEventJson);


    public function raw();


    public function at();


    public function type();


    public function indexed();


    public function message();
}
