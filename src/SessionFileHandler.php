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
 * Class SessionFileHandler
 *
 * @package FastD\Session
 */
class SessionFileHandler extends SessionHandler
{
    /**
     * @var array
     */
    protected $content = [];

    /**
     * @var string
     */
    protected $file;

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
     * @param $savePath
     * @return bool
     */
    public function open($savePath)
    {
        if (!file_exists($savePath)) {
            mkdir($savePath, 0755, true);
        }

        $this->file = $savePath . DIRECTORY_SEPARATOR . $this->getSessionId() . '.session';

        if (!file_exists($this->file)) {
            touch($this->file);
        }

        $this->content = file_get_contents($this->file);

        if (!empty($this->content)) {
            $this->content = json_decode($this->content, true);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function close()
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function destroy()
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    public function set($key, $value = null)
    {
        if (null === $value) {
            $this->content = $key;
        } else {
            $this->content[$key] = $value;
        }

        file_put_contents($this->file, json_encode($this->content, JSON_UNESCAPED_UNICODE));

        return $this;
    }

    /**
     * @param null $key
     * @return array|mixed|null
     */
    public function get($key = null)
    {
        if (null === $key) {
            return $this->content;
        }

        return isset($this->content[$key]) ? $this->content[$key] : null;
    }
}