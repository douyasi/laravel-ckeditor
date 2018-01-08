<?php

namespace Douyasi\CKEditor;

class CKEditorServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        //配置
        $configPath = __DIR__ . '/../config/ckeditor.php';
        $this->mergeConfigFrom($configPath, 'ckeditor');
        $this->publishes([$configPath => config_path('ckeditor.php')], 'config');

        //公共资源
        $publicPath = __DIR__ . '/../public';
        $this->publishes([$publicPath => public_path('')], 'public');

        //视图
        $viewPath = __DIR__ . '/../resources/views';
        $this->publishes([$viewPath => base_path('resources/views/vendor/ckeditor')], 'view');
        $this->loadViewsFrom($viewPath, 'ckeditor');

        //路由
        $routePath = __DIR__ . '/../routes/ckeditor.php';
        if (! $this->app->routesAreCached()) {
            require $routePath;
        }

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ckeditor'];
    }
}
