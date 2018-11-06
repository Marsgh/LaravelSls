<?php
/**
 * Created by PhpStorm.
 * User: lilp08
 * Date: 2018/11/6
 * Time: 10:40
 */

namespace Marsgh\AliYunSls;
use Illuminate\Support\ServiceProvider;

class AliYunSlsServiceProvider  extends ServiceProvider{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aliyun.sls', function ($app) {
            $config = $app->config->get('aliyun-sls');
            return new AliYunSls($config['endpoint'], $config['access_key_id'], $config['access_key'], $config['project'], $config['logstore']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'aliyun.sls'
        ];
    }

    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../config/aliyun-sls.php';
        $this->publishes([
            $configPath => config_path('aliyun-sls.php')
        ]);
        $this->mergeConfigFrom($configPath, 'aliyun-sls');
    }

}