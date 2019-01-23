<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;

use FastD\Session\Adapter\NativeSessionHandler;
use FastD\Http\ServerRequest;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class Session
 *
 * @package FastD\Session
 */
class Session
{
    /**
     * @var string
     */
    const SESSION_KEY = 'session-id';

    /**
     * @var AbstractSessionHandler
     */
    protected $sessionHandler;

    /**
     * @var ServerRequest|\Psr\Http\Message\ServerRequestInterface
     */
    protected $request;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * Session constructor.
     * @param ServerRequest $serverRequest
     * @param SessionHandlerInterface $sessionHandler
     */
    public function __construct(ServerRequest $serverRequest = null, SessionHandlerInterface $sessionHandler = null)
    {
        // FPM create new ServerRequest
        if (null === $serverRequest) {
            $serverRequest = ServerRequest::createServerRequestFromGlobals();
        }

        if (null === $sessionHandler) {
            $sessionHandler = new NativeSessionHandler();
        }

        $this->request = $serverRequest;
        $this->sessionHandler = $sessionHandler;

        if (null === ($this->sessionId = $this->request->getCookie(static::SESSION_KEY, null))) {
            $this->sessionId = version_compare(PHP_VERSION, '7.0.0') >= 1 ? session_create_id() : md5(uniqid());

            $this->request->withCookieParams([
                static::SESSION_KEY => $this->sessionId,
            ]);
        }

        $this->sessionHandler->start($this->sessionId);
    }

    /**
     * @param ServerRequest|null $serverRequest
     * @param AbstractSessionHandler|null $sessionHandler
     * @return Session
     */
    public static function start(ServerRequest $serverRequest = null, AbstractSessionHandler $sessionHandler = null)
    {
        return new static($serverRequest, $sessionHandler);
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get($name, $default = null)
    {
        return $this->sessionHandler->get($name, $default);
    }

    /**
     * @param $key
     * @param $value
     * @param null $ttl
     * @return $this
     * @throws InvalidArgumentException
     */
    public function set($key, $value, $ttl = null)
    {
        $this->sessionHandler->set($key, $value, $ttl);

        return $this;
    }

    /**
     * @param $key
     * @return bool
     * @throws InvalidArgumentException
     */
    public function has($key)
    {
        return $this->sessionHandler->has($key);
    }

    /**
     * @param $key
     * @return $this
     * @throws InvalidArgumentException
     */
    public function delete($key)
    {
        $this->sessionHandler->delete($key);

        return $this;
    }

    /**
     * @return bool
     */
    public function clear()
    {
        return $this->sessionHandler->clear();
    }
}
