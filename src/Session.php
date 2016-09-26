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
     * @var static
     */
    protected static $session;

    /**
     * @var SessionHandler
     */
    protected $sessionHandler;

    /**
     * @var bool
     */
    protected $started = false;

    /**
     * Session constructor.
     *
     * @param null $sessionId
     * @param SessionHandler|null $sessionHandler
     */
    public function __construct($sessionId = null, SessionHandler $sessionHandler = null)
    {
        if (null === $sessionHandler) {
            $sessionHandler = new SessionFileHandler('/tmp');
        }

        $this->sessionHandler = $sessionHandler;

        $sessionHandler->setSessionId($sessionId);
    }

    /**
     * @param null $sessionId
     * @param SessionHandler|null $sessionHandler
     * @return static
     */
    public static function start($sessionId = null, SessionHandler $sessionHandler = null)
    {
        if (null === static::$session) {
            static::$session = new static($sessionId, $sessionHandler);
        }

        return static::$session;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionHandler->getSessionId();
    }

    /**
     * @param $name
     * @return bool
     */
    public function get($name)
    {
        return $this->sessionHandler->get($name);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->sessionHandler->set($name, $value);

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
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->sessionHandler->get(null), JSON_UNESCAPED_UNICODE);
    }
}
