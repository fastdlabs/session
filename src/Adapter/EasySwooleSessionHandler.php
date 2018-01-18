<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

namespace FastD\Session\Adapter;


use easySwoole\Cache\Cache as ES;

/**
 * Class EasySwooleSessionHandler
 * @package FastD\Session\Adapter
 */
class EasySwooleSessionHandler extends NativeSessionHandler
{
    /**
     * @param $key
     * @param $value
     * @param null $ttl
     * @return $this
     */
    public function set($key, $value, $ttl = null)
    {
        return ES::set($key, $value, $ttl);
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return ES::get($key, $default);
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        return ES::delete($key);
    }
}