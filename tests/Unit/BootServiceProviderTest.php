<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Orchestra\Testbench\TestCase;

class BootServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['ACodeNinja\PwnedPasswordsValidator\ServiceProvider'];
    }

    /**
     * Test that the validator can be made with the App Facade
     *
     * @return void
     */
    public function testCanAppMakeValidator()
    {
        try {
            $pwnedPasswordsValidator = App::make('ACodeNinja\\PwnedPasswordsValidator\\Validator');
        } catch (\Exception $appMakeException) {
            $this->fail($appMakeException->getMessage());
        }

        if (empty($appMakeException)) {
            $this->assertNotEmpty($pwnedPasswordsValidator);
        }
    }

    /**
     * Test that the validator can be made using the Validator factory
     */
    public function testCanValidatorMakeValidator()
    {
        try {
            $validator = Validator::make([
                'password' => '>:W^+b,U9B}[i&X>4t;9Qp\Gs/8e!Z~Ey"{j\ol^}yn@"r%0,et/#|,SLC;t=BG'
            ], [
                'password' => 'required|pwned_password_strict',
            ]);
        } catch (\Exception $validatorMakeException) {
            $this->fail($validatorMakeException->getMessage());
        }

        if (empty($validatorMakeException)) {
            $this->assertNotEmpty($validator);
        }
    }
}