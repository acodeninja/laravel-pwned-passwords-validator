<?php

namespace ACodeNinja\PwnedPasswordsValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Extend the laravel validator factory with the validator
        Validator::extend('pwned_password_strict', '\ACodeNinja\PwnedPasswordsValidator\Validator@validateStrict');
    }
}
