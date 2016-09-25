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
 * Class Session
 *
 * @package FastD\Swoole\Http
 */
class Session
{
    const SESSION_KEY = 'X-Session-Id';

    /**
     * @var string
     */
    protected $sessionId;

    protected $sessionContent;

    protected $sessionHandler;

    /**
     * @var bool
     */
    protected $started = false;

    public function __construct($sessionId = null, $sessionHandler = null)
    {
        if (null === $sessionHandler) {
            $sessionHandler = new SessionFile('/tmp');
        }

        $this->sessionHandler = $sessionHandler;

        if (!$this->started) {
            $this->sessionId = $this->getSessionId();
            $this->started = true;
        }
    }

    public static function start($sessionId = null, $sessionHandler = null)
    {
        return new static($sessionId, $sessionHandler);
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        if (null === $this->sessionId) {
            $this->sessionId = (string) new SessionId();
        }

        return $this->sessionId;
    }

    /**
     * @param $name
     * @return bool
     */
    public function get($name)
    {
        return isset($this->sessionContent[$name]) ? $this->sessionContent[$name] : null;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->sessionContent[$name] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->sessionContent = null;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHit()
    {
        return '' != $this->sessionContent;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return (array) $this->sessionContent;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->sessionContent, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return void
     */
    public function __destruct()
    {

    }
}
