# Laravel PwnedPassword Validation
Develop [![Build Status Develop](https://travis-ci.org/acodeninja/laravel-pwned-passwords-validator.svg?branch=develop)](https://travis-ci.org/acodeninja/laravel-pwned-passwords-validator)
Master [![Build Status Master](https://travis-ci.org/acodeninja/laravel-pwned-passwords-validator.svg?branch=master)](https://travis-ci.org/acodeninja/laravel-pwned-passwords-validator)
[![Total Downloads](https://poser.pugx.org/acodeninja/laravel-pwned-passwords-validator/downloads)](https://packagist.org/packages/acodeninja/laravel-pwned-passwords-validator)
[![Latest Stable Version](https://poser.pugx.org/acodeninja/laravel-pwned-passwords-validator/version)](https://packagist.org/packages/acodeninja/laravel-pwned-passwords-validator)
[![Latest Unstable Version](https://poser.pugx.org/acodeninja/laravel-pwned-passwords-validator/v/unstable)](//packagist.org/packages/acodeninja/laravel-pwned-passwords-validator)
[![License](https://poser.pugx.org/acodeninja/laravel-pwned-passwords-validator/license)](https://packagist.org/packages/acodeninja/laravel-pwned-passwords-validator)

Validate that a given string is not present in the pwned passwords list at https://haveibeenpwned.com/Passwords

## Installation

Install using composer from packagist

```bash
composer require acodeninja/laravel-pwned-passwords-validator
```

## Usage

Use as you would any other validation rule

### In a request

```php
/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
public function rules()
{
    return [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|pwned_password_strict',
    ];
}
```

### In a controller

```php
$validator = Validator::make($request->all(), [
    'email' => 'required|email|unique:users,email',
    'password' => 'required|pwned_password_strict',
])->validate();
```
