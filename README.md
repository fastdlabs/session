# Session

不基于 PHP 自身提供的 SessionHandler 对象实现的 Session 管理,缘由处于 Swoole 扩展本身不支持 Session, 因为 Session 本身并非 HTTP 的东西,仅仅是通过 Cookie 进行 SessionId 传输罢了。

## Composer

```
composer require "fastd/session:1.0.x-dev" -vvv
```

## 使用

```php
$session = Session::start();
$session->set('name', 'jan');
```

session 本身操作的是一个数组, 在 redis 中是一个 hash 数据类型。

详细文档: [文档](docs/readme.md)

## LICENSE MIT
