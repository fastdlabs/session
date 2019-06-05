<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;


use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class SessionHandler
 *
 * @package FastD\Session
 */
abstract class AbstractSessionHandler implements SessionHandlerInterface
{
    /**
     * @var CacheInterface
     */
    protected $driver = null;

    /**
     * @var int
     */
    protected $lifecycle = 3600;

    /**
     * @param $sessionId
     * @param CacheInterface|null $cache
     * @param string $directory
     * @return void
     */
    public function start($sessionId, CacheInterface $cache = null, $directory = '/tmp/session')
    {
        if (null === $cache) {
            $cache = new SessionCache($sessionId, $this->lifecycle, $directory);
        }

        $this->driver = $cache;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get($key, $default = null)
    {
		$value = $this->driver->get($key, $default);
		$this->set($key, $value, $this->lifecycle);
		return $value;
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
        $this->driver->set($key, $value, $ttl);

        return $this;
    }

    /**
     * @param $key
     * @return bool
     * @throws InvalidArgumentException
     */
    public function delete($key)
    {
        return $this->driver->delete($key);
    }

    /**
     * @param $key
     * @return bool
     * @throws InvalidArgumentException
     */
    public function has($key)
    {
        return $this->driver->has($key);
    }

    /**
     * @return bool
     */
    public function clear()
    {
        return $this->driver->clear();
    }
}
