<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Session;

use FastD\Storage\Driver\Redis\Redis;

/**
 * Class SessionRedisHandler
 *
 * @package FastD\Session
 */
class SessionRedisHandlerInterface extends SessionHandlerInterface
{
    const SESSION_PREFIX = 'session:';

    /**
     * @var Redis
     */
    protected $redis;

    /**
     * @var array
     */
    protected $config;

    /**
     * SessionRedisHandler constructor.
     *
     * @param array $config
     * @param null $sessionId
     */
    public function __construct(array $config, $sessionId = null)
    {
        $this->config = $config;

        parent::__construct($sessionId, '/tmp');
    }

    /**
     * @param $savePath
     * @return mixed
     */
    public function open($savePath)
    {
        $this->connect();

        return true;
    }

    /**
     *
     */
    protected function connect()
    {
        if (null === $this->redis) {
            $this->redis = Redis::connect($this->config);

            if (isset($this->config['dbindex'])) {
                $this->redis->select($this->config['dbindex']);
            }
        }
    }

    /**
     * @return mixed
     */
    public function close()
    {

    }

    /**
     * @return mixed
     */
    public function destroy()
    {
        $this->close();
    }

    /**
     * @param $key
     * @param null $value
     * @return mixed
     */
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->redis->hmset($this->getSessionId(static::SESSION_PREFIX), $key);
        } else {
            $this->redis->hmset($this->getSessionId(static::SESSION_PREFIX), [
                $key => $value
            ]);
        }
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function get($key = null)
    {
        if (null === $key) {
            return $this->redis->hgetall($this->getSessionId(static::SESSION_PREFIX));
        }

        return $this->redis->hget($this->getSessionId(static::SESSION_PREFIX), $key);
    }

    /**
     * @return mixed
     */
    public function clear()
    {
        $this->redis->del($this->getSessionId(static::SESSION_PREFIX));

        $this->set([]);
    }
}