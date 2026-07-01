<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::query()
            ->select(['id', 'name', 'real_state_type', 'city', 'country'])
            ->latest('id')
            ->paginate(20);

        return PropertyResource::collection($properties);
    }

    public function store(StorePropertyRequest $request)
    {
        $data = $request->validated();
        $data['country'] = strtoupper($data['country']);
        $property = Property::query()->create($data);

        return new PropertyResource($property);
    }

    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $data['country'] = strtoupper($data['country']);
        $property->update($data);

        return new PropertyResource($property);
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return new PropertyResource($property);
    }
}
