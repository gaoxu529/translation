<?php

namespace risingsun\Translation;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(realpath(__DIR__ . '/config/Translation.php'), 'Translation');
        //
        $this->app->bind('risingsun\Translation\TranslationService', function ($app) {
            $default = $app['config']['Translation.default'];
            return TranslationFactory::create($default);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__ . '/config/Translation.php' => config_path("Translation.php")
        ]);
    }
}