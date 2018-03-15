<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\Validator;
use Orchestra\Testbench\TestCase;

class ValidationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['ACodeNinja\PwnedPasswordsValidator\ServiceProvider'];
    }

    /**
     * Test that validating with no password fails validation
     */
    public function testValidateWithoutPasswordFailsValidation()
    {
        $validator = Validator::make([], [
            'password' => 'required|pwned_password_strict',
        ]);

        $this->assertTrue($validator->fails());
    }

    /**
     * Test that validating a simple known password fails validation
     */
    public function testValidateKnownPasswordFailsValidation()
    {
        $validator = Validator::make([
            'password' => 'qwerty'
        ], [
            'password' => 'required|pwned_password_strict',
        ]);

        $this->assertTrue($validator->fails());
    }

    /**
     * Test that validating a complex known missing password does not fail validation
     */
    public function testValidateKnownPasswordPassesValidation()
    {
        $validator = Validator::make([
            'password' => '>:W^+b,U9B}[i&X>4t;9Qp\Gs/8e!Z~Ey"{j\ol^}yn@"r%0,et/#|,SLC;t=BG'
        ], [
            'password' => 'required|pwned_password_strict',
        ]);

        $this->assertFalse($validator->fails());
    }
}