<?php

declare(strict_types = 1);

namespace Ceiboo\Modules\Geo\Eloquent;

final class CityNotExist
{
    static public function Error():array
    {
        // Map Domain User model values
        return [
            'data' => ['error'=>'El codigo postal no existe'],
            'code' => 422
        ];
    }
}
