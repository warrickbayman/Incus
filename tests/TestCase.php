<?php
/**
 * Incus
 * 
 * @copyright   Copyright (c) 2014 Warrick Bayman.
 * @author		Warrick Bayman <me@warrickbayman.co.za>
 * @license     MIT License http://opensource.org/licenses/MIT
 * 
 */

require __DIR__."/../vendor/autoload.php";

use Incus\Incus;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        date_default_timezone_set('Africa/Johannesburg');
        $_POST['mandrill_events'] = file_get_contents(__DIR__.'/example.json');
    }

    public function tearDown()
    {

    }
}
