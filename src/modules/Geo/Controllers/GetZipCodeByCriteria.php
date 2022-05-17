<?php

namespace Ceiboo\Modules\Geo\Controllers;

use Ceiboo\Modules\Geo\Eloquent\SettlementNotExist;
use Ceiboo\Modules\Geo\Eloquent\ZipCode;
use Illuminate\Http\Request;

final class GetZipCodeByCriteria
{
    public function __invoke(Request $request)
    {
        $zip_code = (string) $request->zip_code;

        $query=ZipCode::where('zip_code', $zip_code)->get(['jsondata'])->toArray();
        if(!count($query)){
            return SettlementNotExist::Error();
        }
        return ['data' => json_decode($query[0]['jsondata'],true), 'code' => 200];
    }

}
