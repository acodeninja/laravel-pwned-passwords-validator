<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\Validator;
use Orchestra\Testbench\TestCase;

class ValidationMessageTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['ACodeNinja\PwnedPasswordsValidator\ServiceProvider'];
    }

    /**
     * Test that the error message received from the validator matches the translation in use
     */
    public function testValidationFailureMessage()
    {
        $validator = Validator::make([
            'password' => 'qwerty'
        ], [
            'password' => 'required|pwned_password_strict',
        ]);

        $errors = $validator->errors();

        $this->assertEquals(trans('pwned_validator::validation.pwned_password_strict'), $errors->first('password'));
    }

}