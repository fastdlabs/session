<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

include __DIR__ . '/../vendor/autoload.php';

$face = new \Hanson\Face\Foundation\Face();

$result = $face->score->get('https://ws2.sinaimg.cn/large/685b97a1gy1fehkmbi6hvj20u00u07ab.jpg');

print_r($result);