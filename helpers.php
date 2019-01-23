<?php

use FastD\Http\ServerRequest;
use FastD\Session\AbstractSessionHandler;
use FastD\Session\Session;

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

/**
 * @param ServerRequest|null $serverRequest
 * @return Session
 */
if (!function_exists('session')) {
    function session (ServerRequest $serverRequest = null, AbstractSessionHandler $handler = null)
    {
        return Session::start($serverRequest, $handler);
    }
}
