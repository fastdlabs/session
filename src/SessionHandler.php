<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;

use SessionHandlerInterface;

/**
 * Class SessionHandler
 *
 * @package FastD\Http\Session
 */
abstract class SessionHandler implements SessionHandlerInterface
{
    protected $sessionId;

    public function setSessionId($sessionId)
    {
        if (null === $sessionId) {
            $sessionId = (string) new SessionId();
        }

        $this->sessionId = $sessionId;

        return $this;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return bool
     */
    public function isHit()
    {

    }
}