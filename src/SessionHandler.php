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
 * @package FastD\Session
 */
abstract class SessionHandler
{
    /**
     * @var string
     */
    protected $sessionId;

    /**
     * SessionFileHandler constructor.
     *
     * @param null $sessionId
     * @param string $savePath
     */
    public function __construct($sessionId = null, $savePath = '/tmp')
    {
        $this->setSessionId($sessionId);

        $this->open($savePath);
    }

    /**
     * @param $sessionId
     * @return $this
     */
    public function setSessionId($sessionId)
    {
        if (null === $sessionId) {
            $sessionId = (string) new SessionId();
        }

        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * @param string $prefix
     * @return string
     */
    public function getSessionId($prefix = '')
    {
        return $prefix . $this->sessionId;
    }

    /**
     * @param $savePath
     * @return mixed
     */
    abstract public function open($savePath);

    /**
     * @return mixed
     */
    abstract public function close();

    /**
     * @return mixed
     */
    abstract public function destroy();

    /**
     * @param $key
     * @param null $value
     * @return mixed
     */
    abstract public function set($key, $value = null);

    /**
     * @param null $key
     * @return mixed
     */
    abstract public function get($key = null);

    public function __destruct()
    {
        $this->close();
    }
}