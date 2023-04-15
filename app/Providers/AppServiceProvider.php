<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 's929wf9r279st586',
                    'publicKey' => 'ncfzk5b488ppxrn8',
                    'privateKey' => '81111e1825a7240bd98484774a1facaf',
                ]
            );
        });
    }
}
