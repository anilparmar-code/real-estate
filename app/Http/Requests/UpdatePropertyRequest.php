<?php

namespace App\Http\Requests;

use App\Enums\Property\RealStateTypeEnum;
use App\Rules\ISO2CountryCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdatePropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:128'],
            'real_state_type' => ['sometimes', new Enum(RealStateTypeEnum::class)],
            'street' => ['sometimes', 'string', 'max:128'],
            'external_number' => ['sometimes', 'string', 'max:12', 'regex:/^[a-zA-Z0-9-]+$/'],
            'internal_number' => [Rule::when(
                in_array($this->input('real_state_type'), [RealStateTypeEnum::DEPARTMENT->value, RealStateTypeEnum::COMMERCIAL_GROUND->value]),
                'required|string|regex:/^[a-zA-Z0-9-\s]+$/',
            ), Rule::when(
                $this->input('internal_number') && in_array($this->input('real_state_type'), [RealStateTypeEnum::HOUSE->value, RealStateTypeEnum::LAND->value]),
                'nullable|string|regex:/^[a-zA-Z0-9-\s]+$/',
            )],
            'neighborhood' => ['sometimes', 'string', 'max:128'],
            'city' => ['sometimes', 'string', 'max:64'],
            'country' => ['sometimes', 'string', new ISO2CountryCodeRule()],
            'rooms' => ['sometimes', 'integer', 'min:1'],
            'bathrooms' => [
                Rule::when(in_array($this->input('real_state_type'), [RealStateTypeEnum::LAND->value, RealStateTypeEnum::COMMERCIAL_GROUND->value]), 'nullable|integer|min:0'),
                Rule::when(in_array($this->input('real_state_type'), [RealStateTypeEnum::HOUSE->value, RealStateTypeEnum::DEPARTMENT->value]), 'required|integer|min:1'),
            ],
            'comments' => ['nullable', 'string', 'max:128'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
