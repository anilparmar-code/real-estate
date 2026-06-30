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
        return [
            'name' => $this->faker->word(),
            'real_state_type' => $this->faker->randomElement(RealStateTypeEnum::values()),
            'street' => $this->faker->streetName(),
            'external_number' => $this->faker->buildingNumber(),
            'internal_number' => $this->faker->optional()->buildingNumber(),
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'country' => $this->faker->countryCode(),
            'rooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'comments' => $this->faker->optional()->sentence(),
        ];
    }
}
