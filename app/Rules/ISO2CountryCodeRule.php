<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use League\ISO3166\ISO3166;

class ISO2CountryCodeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            (new ISO3166())->alpha2(strtoupper($value));
        } catch (\Exception $e) {
            $fail('The :attribute must be a valid ISO 3166-Alpha2 country code.');
        }
    }
}
