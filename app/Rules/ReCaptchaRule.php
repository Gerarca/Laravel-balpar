<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReCaptchaRule implements Rule
{
    public function passes($attribute, $value)
    {
        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'secret' => config('api.google_recaptcha_secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ],
        ]);

        $response = json_decode(curl_exec($ch));

        return $response && $response->success;
    }

    public function message()
    {
        return 'Error al validar el captcha. Por favor vuelva a intentarlo';
    }
}
