<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Session\SessionPhpHandler;

include __DIR__ . '/../vendor/autoload.php';

$sessionHandler = new SessionPhpHandler();
//$sessionHandler->set('name', 'jan');

$session = $sessionHandler->get();

print_r($session);
