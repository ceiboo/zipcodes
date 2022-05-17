<?php

namespace Ceiboo\Api\Commands;

use Illuminate\Console\Command;
use Ceiboo\Modules\Geo\Eloquent\GetZipCodeToArray;
use Ceiboo\Modules\Geo\Eloquent\Settlement;
use Ceiboo\Modules\Geo\Eloquent\SettlementToArray;
use Ceiboo\Modules\Geo\Eloquent\ZipCode;

final class QueryCommand extends Command
{
    protected $signature = 'api:query';

    private $last_id=1;

    public function handle()
    {
        $this->info("Iniciando proceso de Cache");
        $zipCodes = Settlement::distinct()->get(['zip_code']);
        foreach($zipCodes as $zipCode)
        {
            $zip_code = $zipCode['zip_code'];
            $this->info($zip_code);
            $query=Settlement::with('city','city.entity')->where('zip_code', $zip_code)->get()->toArray();
            $settlements = [];
            foreach($query as $settlement) {
                $settlements[] = SettlementToArray::toArray($settlement);
            }
            $jsondata = json_encode(GetZipCodeToArray::toArray($zip_code,$query[0]['city'],$settlements));
            $this->saveZipCode($zip_code,$jsondata);
        }

    }

    private function saveZipCode($zip_code,$jsondata)
    {
        $zipcode = new ZipCode();
        $zipcode->id        = $this->last_id;
        $zipcode->zip_code  = $zip_code;
        $zipcode->jsondata  = $jsondata;
        $zipcode->save();
        $this->last_id++;
    }
}
