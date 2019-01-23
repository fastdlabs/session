<?php

use FastD\Session\Adapter\NativeSessionHandler;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;

include __DIR__ . '/../vendor/autoload.php';

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2019
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

class Handler extends NativeSessionHandler
{
    protected $lifecycle = 86400;
}

$session = \FastD\Session\Session::start(null, new Handler());

echo '<pre>';
print_r($session);

