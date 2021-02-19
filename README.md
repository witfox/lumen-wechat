<h1 align="center"> lumen-wechat </h1>

## 描述

这是基于lumen框架编辑的,微信公众号的组件

## 安装

```shell
$ composer require witfox/lumen-wechat:dev
```


## 配置文件发布

```shell
php artisan vendor:publish --provider="WitFox\LumenWechat\WeChatServiceProvider"
```

## 配置

Laravel 应用
在 config/app.php 注册 ServiceProvider 和 Facade (Laravel 5.5 无需手动注册)
```
'providers' => [
    // ...
    ShineYork\LaravelWechat\WeChatServiceProvider::class,
]
```
然后在浏览器中访问的路由如下 http://localhost/swechat
```
Route::any('/', 'WeChatController@index')->middleware('swechat.check');
```
