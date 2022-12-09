<?php

namespace App\Providers;

use App\Interface\GooglePlacesApiInterface;
use App\Services\Api\GooglePlacesApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //todo:bind interface service
        $this->app->bind(GooglePlacesApiInterface::class, GooglePlacesApiService::class);
//        $this->app->singleton(
//            abstract: MedicalTrustService::class,
//            concrete: fn () => new MedicalTrustService(
//                baseUrl: strval(config('services.medical-trust.url')),
//                apiToken: strval(config('services.medical-trust.token')),
//            ),
//        );
    }
}
