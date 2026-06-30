<?php


use App\Models\Property;

test('return a list of properties', function () {
    Property::factory(5)->create();

    $response = $this->get('api/properties');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

test('can create a new property', function () {
    $response = $this->post('api/properties', [
        'name' => 'Test Property',
        'real_state_type' => 'house',
        'street' => '123 Main St',
        'external_number' => '456',
        'internal_number' => null,
        'neighborhood' => 'Downtown',
        'city' => 'Test City',
        'country' => 'US',
        'rooms' => 3,
        'bathrooms' => 2,
        'comments' => null,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('properties', [
        'name' => 'Test Property',
    ]);
});

test('can return a single property', function () {
    $property = Property::factory()->create();

    $response = $this->get("api/properties/{$property->id}");

    $response->assertStatus(200);
});

test('can update a property', function () {
    $property = Property::factory()->create();

    $response = $this->put("api/properties/{$property->id}", [
        'name' => 'updated title',
    ]);

    $this->assertDatabaseHas('properties', [
        'id' => $property->id,
        'name' => 'updated title',
    ]);
});

test('can delete property', function () {
    $property = Property::factory()->create();

    $response = $this->delete("api/properties/{$property->id}");

    $response->assertStatus(200);
    $this->assertSoftDeleted('properties', [
        'id' => $property->id,
    ]);
});
