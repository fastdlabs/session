<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

namespace FastD\Session;


use Psr\SimpleCache\CacheInterface;

/**
 * Interface SessionHandlerInterface
 * @package FastD\Session
 */
interface SessionHandlerInterface
{
    /**
     * @param $sessionId
     * @param CacheInterface|null $cache
     * @return mixed
     */
    public function start($sessionId, CacheInterface $cache = null);

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param $key
     * @param $value
     * @param null $ttl
     * @return $this
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function set($key, $value, $ttl = null);

    /**
     * @param $key
     * @return bool
     */
    public function delete($key);

    /**
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * @return mixed
     */
    public function clear();
}