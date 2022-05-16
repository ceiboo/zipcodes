<?php

namespace Ceiboo\Modules\Geo\Controllers;

use Ceiboo\Modules\Geo\Eloquent\City;
use Ceiboo\Modules\Geo\Eloquent\CityNotExist;
use Ceiboo\Modules\Geo\Eloquent\GetZipCodeToArray;
use Ceiboo\Modules\Geo\Eloquent\Settlement;
use Ceiboo\Modules\Geo\Eloquent\SettlementNotExist;
use Ceiboo\Modules\Geo\Eloquent\SettlementToArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class PutCacheZipCode
{
    public function __invoke(Request $request)
    {
        $settlements = Settlement::distinct()->where('id','<',200)->get(['zip_code']);
        foreach($settlements as $settlement)
        {
            $zip_code = $settlement['zip_code'];
            Cache::rememberForever($zip_code, function() use($zip_code) {
                return Settlement::with('city','city.entity')->where('zip_code', $zip_code)->get()->toArray();
            });
        }

         return [
            'data' => ['last'=>$zip_code],
            'code' => 200
        ];
    }

}
