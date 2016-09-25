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
 * Class SessionId
 *
 * @package FastD\Session
 */
class SessionId
{
    /**
     * @var string
     */
    protected $sessionId;

    /**
     * SessionId constructor.
     */
    public function __construct()
    {
        $this->sessionId = $this->buildId();
    }

    /**
     * @return string
     */
    protected function buildId()
    {
        return md5(microtime(true) . mt_rand(000000, 999999));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->sessionId;
    }
}