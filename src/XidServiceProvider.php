<?php

namespace Yormy\Xid;

use Illuminate\Support\ServiceProvider;

class XidServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
//            $this->publishes([
//                __DIR__ . '/../config/config.php' => config_path('xid.php'),
//            ], 'config');
        }

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'xid');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'xid');
    }
}
