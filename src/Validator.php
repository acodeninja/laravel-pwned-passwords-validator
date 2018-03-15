<?php

namespace ACodeNinja\PwnedPasswordsValidator;


use GuzzleHttp\Client;
use Illuminate\Validation\Validator as IlluminateValidator;

class Validator
{
    /**
     * haveibeenpwned.com api endpoint
     */
    const PWNED_PASSWORDS_URI = 'https://api.pwnedpasswords.com/range/';

    /**
     * @var Client
     */
    private $client;

    /**
     * Validator constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $attribute
     * @param string $value
     * @param array $parameters
     * @param IlluminateValidator $validator
     * @return bool
     */
    public function validateStrict(string $attribute, string $value, array $parameters, IlluminateValidator $validator)
    {
        return false === $this->existsOnPwnedPasswords($value);
    }

    /**
     * @param string $password
     * @return bool
     */
    private function existsOnPwnedPasswords(string $password)
    {
        $hashed_password = strtoupper(sha1(utf8_encode($password)));

        $response = $this->client->get(self::PWNED_PASSWORDS_URI.substr($hashed_password, 0, 5));

        $pwned_passwords = (string) $response->getBody();

        return (boolean) strpos($pwned_passwords, substr($hashed_password, 5));
    }
}