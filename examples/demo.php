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

$session->set('foo', 'bar');
$session->set('foo.bar', 'foobar');

echo "<pre>";
echo $session->get('foo');
echo $session->get('foo.bar');
print_r($session);



