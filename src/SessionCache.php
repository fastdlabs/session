<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2019
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace FastD\Session;


use Symfony\Component\Cache\PruneableInterface;
use Symfony\Component\Cache\Simple\AbstractCache;
use Symfony\Component\Cache\Traits\FilesystemTrait;

class SessionCache extends AbstractCache implements PruneableInterface
{
    use FilesystemTrait;

    /**
     * @param string      $namespace
     * @param int         $defaultLifetime
     * @param string|null $directory
     */
    public function __construct($namespace = '', $defaultLifetime = 0, $directory = null)
    {
        parent::__construct($namespace, $defaultLifetime);
        $this->init($namespace, $directory);
    }

}