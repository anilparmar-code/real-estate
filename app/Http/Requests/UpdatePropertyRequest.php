<?php

namespace App\Http\Requests;

use App\Enums\Property\RealStateTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdatePropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:128'],
            'real_state_type' => [new Enum(RealStateTypeEnum::class)],
            'street' => ['string', 'max:128'],
            'external_number' => ['string', 'max:12', 'alpha_dash'],
            'internal_number' => ['nullable', 'string', 'alpha_dash:'],
            'neighborhood' => ['string', 'max:128'],
            'city' => ['string', 'max:64'],
            'country' => ['string', 'max:2'],
            'rooms' => ['integer', 'min:1'],
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
