<?php

namespace App\Http\Requests;

use App\Enums\Property\RealStateTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StorePropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:128'],
            'real_state_type' => ['required', new Enum(RealStateTypeEnum::class)],
            'street' => ['required', 'string', 'max:128'],
            'external_number' => ['required', 'string', 'max:12', 'alpha_dash'],
            'internal_number' => ['nullable', 'string', 'alpha_dash:'],
            'neighborhood' => ['required', 'string', 'max:128'],
            'city' => ['required', 'string', 'max:64'],
            'country' => ['required', 'string', 'max:2'],
            'rooms' => ['required', 'integer', 'min:1'],
            'bathrooms' => [
                Rule::when(in_array($this->input('real_state_type'), [RealStateTypeEnum::LAND->value, RealStateTypeEnum::COMMERCIAL_GROUND->value]), 'integer|min:0'),
                Rule::when(in_array($this->input('real_state_type'), [RealStateTypeEnum::HOUSE->value, RealStateTypeEnum::DEPARTMENT->value]), 'integer|min:1'),
            ],
            'comments' => ['nullable', 'string', 'max:128'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
