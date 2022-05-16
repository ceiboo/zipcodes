<?php

namespace Ceiboo\Modules\Geo\Eloquent;

class SettlementToArray
{

    static public function toArray(array $settlement):array
    {
        return [
                'key'       => $settlement['key'],
                'name'      => $settlement['name'],
                'zone_type' => $settlement['zone_type'],
                'settlement_type' => [
                    'name' => $settlement['type'],
                ]
            ];
    }
}
