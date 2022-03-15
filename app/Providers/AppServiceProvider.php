<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Webauthn\AttestationStatement\AndroidSafetyNetAttestationStatementSupport;
use Webauthn\AttestationStatement\AttestationStatementSupport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->extend(AttestationStatementSupport::class, function ($manager) {
//            $manager->add(new AndroidSafetyNetAttestationStatementSupport());
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
            Passport::tokensExpireIn(now()->addDays(2));
        }
    }
}
