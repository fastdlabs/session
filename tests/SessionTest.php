<?php

use FastD\Session\Session;

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class SessionTest extends PHPUnit_Framework_TestCase
{
    public function testSession()
    {
        $session = Session::start();

//        print_r($session);
    }
}
