<?php
use FastD\Session\SessionFileHandler;

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class SessionFileHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testSessionFile()
    {
        $sessionHandler = new SessionFileHandler();

        print_r($sessionHandler);
    }
}
