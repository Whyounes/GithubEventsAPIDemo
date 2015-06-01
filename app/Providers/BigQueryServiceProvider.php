<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;

class BigQueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('GoogleClient', function () {
            $googleClient = new \Google_Client();
            $googleClient->setAccessToken(\Session::get('token'));

            return $googleClient;
        });

        $this->app->bind('bigquery', function ($app) {
            $googleClient = $app->make('GoogleClient');
            $bigquery = new \Google_Service_Bigquery($googleClient);

            return $bigquery;
        });
    }
}
