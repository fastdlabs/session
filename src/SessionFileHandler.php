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
 * Class SessionRedis
 *
 * @package FastD\Http\Session\Storage
 */
class SessionFileHandler extends SessionHandler
{
    protected $resource;

    protected $content = [];

    protected $file;

    public function __construct($sessionId = null, $savePath = '/tmp')
    {
        $this->setSessionId($sessionId);

        $this->open($savePath);
    }

    public function open($savePath)
    {
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }

        $this->file = $savePath . DIRECTORY_SEPARATOR . $this->getSessionId() . '.session';

        if (!file_exists($this->file)) {
            touch($this->file);
        }

        $this->resource = fopen($this->file, 'rw+');

        $this->content = file_get_contents($this->file);

        if (!empty($this->content)) {
            $this->content = json_decode($this->content, true);
        }

        return true;
    }

    public function close()
    {
        fclose($this->resource);
    }

    public function destroy()
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }

    public function set($key, $value)
    {
        $this->content[$key] = $value;

        return $this;
    }

    public function get($key = null)
    {
        if (null === $key) {
            return $this->content;
        }

        return isset($this->content[$key]) ? $this->content[$key] : null;
    }
}