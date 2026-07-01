<?php

namespace Database\Factories;

use App\Enums\Property\RealStateTypeEnum;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(RealStateTypeEnum::values());

        return [
            'name' => $this->faker->word(),
            'real_state_type' => $type,
            'street' => $this->faker->streetName(),
            'external_number' => $this->faker->buildingNumber(),
            'internal_number' => $type == RealStateTypeEnum::DEPARTMENT->value || $type == RealStateTypeEnum::COMMERCIAL_GROUND->value ? $this->faker->buildingNumber() : null,
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'country' => $this->faker->countryCode(),
            'rooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'comments' => $this->faker->optional()->sentence(),
        ];
    }
}
