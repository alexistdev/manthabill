<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CaptchaRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $word = session('captchaword');

        if (!$word || strtolower((string) $value) !== strtolower((string) $word)) {
            $fail('Captcha yang anda masukkan salah!');
        }
    }
}
