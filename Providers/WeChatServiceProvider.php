<?php
namespace WitFox\LumenWechat\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WeChatServiceProvider extends ServiceProvider{

    protected $routeMiddleware = [
        'lwechat.check' => \WitFox\LumenWechat\Http\Middleware\LWeChartCheck::class
    ];
    protected $middlewareGroups = [];

    public function register()
    {
        //加载配置文件
        $this->mergeConfigFrom(
            __DIR__.'/../Config/wechat.php', 'lwechat'
        );
    }

    public function boot()
    {
        $this->registerRoutes();
    }

    //加载中间件到路由
    protected function syncMiddlewareToRouter()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }

    private function routeConfiguration(): array
    {
        return [
            'namespace' => 'WitFox\LumenWechat\Http\Controllers',
            'prefix' => 'lwechat'
        ];
    }

    //注册路由
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function (){
           $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        });
    }

}
