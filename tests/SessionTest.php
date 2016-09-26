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
        $session = Session::start('eabaadb7946de746c0cc738a7d7be6a0');

        $this->assertEquals($session->getHeader(), [
            'X-Session-Id' => 'eabaadb7946de746c0cc738a7d7be6a0'
        ]);

        $this->assertEquals('eabaadb7946de746c0cc738a7d7be6a0', $session->getSessionId());

        $session->set('name', 'jan');
        $session->set('height', 180);

        $this->assertEquals($session->get(), [
            'name' => 'jan',
            'height' => 180
        ]);
    }

    public function testSessionExists()
    {
        $session = Session::start('eabaadb7946de746c0cc738a7d7be6a0');

        $this->assertEquals([
            'name' => 'jan',
            'height' => 180
        ], $session->get());

        $this->assertEquals('jan', $session->get('name'));
    }
}
