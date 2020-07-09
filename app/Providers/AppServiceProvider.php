<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 支付宝
        $this->app->singleton('alipay', function () {
            $config = config('pay.alipay');
            $config['notify_url'] = route('api.v1.orders.alipay.notify');
            $config['return_url'] = route('api.v1.orders.alipay.return');
            // 判断当前项目运行环境是否为线上环境
            if (app()->environment() !== 'production') {
                $config['mode']         = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }
            // 调用 Yansongda\Pay 来创建一个支付宝支付对象
            return Pay::alipay($config);
        });

        // esign
        $this->app->singleton('esign', function () {
            $config = [
                'debug' => true, // 是否开启调试
                'app_id' => "****", // 请替换成自己的 AppId
                'secret' => '****', // 请替换成自己的 Secret
                'production' => false, // 是否正式环境

                'log' => [
                    'level'      => 'debug',
                    'permission' => 0777,
                    'file'       =>  storage_path('logs'), // 开启调试时有效, 可指定日志文件地址
                ],
            ];
            return new \Achais\ESign\Application($config);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
