<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;

/**
 * Class SessionHandler
 *
 * @package FastD\Http\Session
 */
abstract class SessionHandler
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

    abstract public function open($savePath);

    abstract public function close();

    abstract public function destroy();

    abstract public function set($key, $value);

    abstract public function get($key = null);

    public function __destruct()
    {
        $this->close();
    }
}