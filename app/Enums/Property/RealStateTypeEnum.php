<?php

namespace App\Enums\Property;

enum RealStateTypeEnum: string
{
    case HOUSE = 'house';
    case DEPARTMENT = 'department';
    case LAND = 'land';
    case COMMERCIAL_GROUND = 'commercial_ground';

    public static function values(): array
    {
        return array_map(fn (self $type) => $type->value, self::cases());
    }
}
