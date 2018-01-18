<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;

use Predis\Client;

/**
 * Class SessionRedisHandler
 *
 * @package FastD\Session
 */
class RedisSessionHandler extends AbstractSessionHandler
{
    /**
     * @var \Redis|Client
     */
    protected $redis;

    /**
     * RedisSessionHandler constructor.
     * @param $redis
     */
    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param $key
     * @param $value
     * @param null $ttl
     * @return $this|bool|mixed
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->redis->set($key, $value, $ttl);
    }

    /**
     * @param $key
     * @param null $default
     * @return bool|mixed|null|string
     */
    public function get($key, $default = null)
    {
        if ($this->redis->exists($key)) {
            return $this->redis->get($key);
        }

        return $default;
    }

    /**
     * @param $key
     * @return bool|int
     */
    public function delete($key)
    {
        return $this->redis->del($key);
    }
}