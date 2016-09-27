<?php
use FastD\Session\SessionRedisHandler;

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class SessionRedisHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testStorage()
    {
        $sessionHandler = new SessionRedisHandler([
            'host' => '11.11.11.22',
            'port' => 6379,
            'dbindex' => 4
        ]);

        $sessionHandler->set('name', 'jan');
        $this->assertEquals('jan', $sessionHandler->get('name'));

        $sessionHandler->set([
            'age' => '18'
        ]);

        $this->assertEquals([
            'name' => 'jan',
            'age' => 18,
        ], $sessionHandler->get());
    }
}
