<?php

namespace MBober35\Helpers\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ImplicitRule;

class ReCaptcha implements ImplicitRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function passes($attribute, $value)
    {
        if (empty($value)) return false;
        $client = new Client();
        $response = $client->post("https://www.google.com/recaptcha/api/siteverify", [
            "form_params" => [
                "secret" => config("re-captcha.secretKey"),
                "response" => $value,
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return isset($body["success"]) && $body["success"] === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return config("re-captcha.message");
    }
}
