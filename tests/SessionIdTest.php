<?php

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class SessionIdTest extends PHPUnit_Framework_TestCase
{
    public function testSessionIdBuild()
    {
        $sessionId = new \FastD\Session\SessionId();

        $this->assertNotEmpty($sessionId);
        $this->assertEquals(32, strlen($sessionId));
    }
}
