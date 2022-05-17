<?php

declare(strict_types = 1);

namespace Ceiboo\Modules\Geo\Eloquent;

final class GetZipCodeToArray
{
    static public function toArray(string $zip_code, array $city, array $settlements):array
    {
        // Map Domain User model values
        return [
            'zip_code' => $zip_code,
            'locality' => $city['locality'],
            'federal_entity' => [
                'key'=> $city['entity']['key'],
                'name'=> $city['entity']['name'],
                'code'=> $city['entity']['code'],
            ],
            'settlements' => $settlements,
            'municipality' => [
                'key'=> $city['key'],
                'name'=> $city['name'],
            ]
        ];
    }
}
