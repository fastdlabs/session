<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;


use FastD\Http\ServerRequest;
use FastD\Utils\ArrayObject;

/**
 * Class Session
 *
 * @package FastD\Session
 */
class Session extends ArrayObject
{
    /**
     * @var string
     */
    const SESSION_KEY = 'Session-Id';

    /**
     * @var static
     */
    protected static $session;

    /**
     * @var SessionHandlerInterface
     */
    protected $sessionHandler;

    /**
     * @var ServerRequest|\Psr\Http\Message\ServerRequestInterface
     */
    protected $request;

    /**
     * Session constructor.
     * @param ServerRequest|null $serverRequest
     * @param SessionHandlerInterface|null $sessionHandler
     */
    public function __construct(ServerRequest $serverRequest = null, SessionHandlerInterface $sessionHandler = null)
    {
        if (null === $serverRequest) {
            $serverRequest = ServerRequest::createServerRequestFromGlobals();
        }

        if (null === $sessionHandler) {
            $sessionHandler = new SessionPhpHandlerInterface();
        }

        $this->request = $serverRequest;
        $this->sessionHandler = $sessionHandler;
    }

    /**
     * @param SessionHandlerInterface|null $sessionHandler
     * @return Session
     */
    public static function start(SessionHandlerInterface $sessionHandler = null)
    {
        if (null === static::$session) {
            static::$session = new static();
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
    public function get($name = null)
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

    public function isHit()
    {

    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->sessionHandler->clear();

        return $this;
    }
}
