<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // diffForHumans 是 Carbon 对象提供的方法，默认情况是英文的,如果要使用中文时间提示，则需要对 Carbon 进行本地化设置
        //AppServiceProvider 是框架的核心，在 Laravel 启动时，会最先加载该文件
        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
