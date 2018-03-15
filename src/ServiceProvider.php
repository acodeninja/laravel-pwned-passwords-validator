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
        // Register translations for the validator
        $this->loadTranslationsFrom(__DIR__.'/translations', 'pwned_validator');

        $this->publishes([
            __DIR__.'/translations' => resource_path('lang/vendor/pwned_validator'),
        ]);

        // Extend the laravel validator factory with the validator
        Validator::extend('pwned_password_strict', '\ACodeNinja\PwnedPasswordsValidator\Validator@validateStrict');

        // Add the replacer for the pwned_password_strict validator
        Validator::replacer('pwned_password_strict', function ($message, $attribute, $rule, $parameters) {
            return trans('pwned_validator::validation.pwned_password_strict');
        });
    }
}
