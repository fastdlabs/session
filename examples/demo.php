<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Session\Session;

include __DIR__ . '/../vendor/autoload.php';

$session = Session::start();

$session->set('name', 'test');

echo "<pre>";
print_r($session);
