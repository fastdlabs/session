<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

include __DIR__ . '/../vendor/autoload.php';

$session = session();

$session->set('foo', 'bar');
$response = new \FastD\Http\Response('ok');
$response->withCookie('session-id', $session->getSessionId());

$response->send();
