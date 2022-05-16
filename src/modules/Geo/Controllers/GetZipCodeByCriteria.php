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

final class GetZipCodeByCriteria
{
    public function __invoke(Request $request)
    {
        $zip_code = (string) $request->zip_code;
        /*
        $settlements = Settlement::where('zip_code', $zip_code)->get()->toArray();

        if(!count($settlements)){
            return SettlementNotExist::Error();
        }

        $city_id=$settlements[0]['city_id'];
        $city = City::where('id', $city_id)->with('entity')->get()->toArray();

        if (!count($city)) {
            return CityNotExist::Error();
        }
        */

        $query = Cache::rememberForever($zip_code, function() use($zip_code) {
            return Settlement::with('city','city.entity')->where('zip_code', $zip_code)->get()->toArray();
        });

        $settlements = [];
        foreach($query as $settlement) {
            $settlements[] = SettlementToArray::toArray($settlement);
        }

        return GetZipCodeToArray::toArray($zip_code,$query[0]['city'],$settlements);
    }

}
