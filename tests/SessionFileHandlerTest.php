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
        $sessionHandler = new SessionFileHandler('a2b76a055d5d2cbdc3b50bcabc23ea53');

        $sessionHandler->set('name', 'jan');

        $content = $sessionHandler->get();

        $this->assertEquals(['name' => 'jan'], $content);
        $this->assertEquals('jan', $sessionHandler->get('name'));
    }
}
