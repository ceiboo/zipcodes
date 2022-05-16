<?php

namespace Ceiboo\Api\Commands;

use Illuminate\Console\Command;
use Ceiboo\Modules\Geo\Eloquent\Entity;
use Ceiboo\Modules\Geo\Eloquent\City;
use Ceiboo\Modules\Geo\Eloquent\Settlement;
use Ceiboo\Modules\Geo\Eloquent\SettlementNotExist;
use Illuminate\Support\Facades\Cache;

final class CacheCommand extends Command
{
    protected $signature = 'api:cache';

    private $last_zip_code=0;

   /* public function handle()
    {
        $this->info("Iniciando proceso de Cache");
        //$s = new Settlement();
        //$settlements = $s->get()->toArray();
        $settlements = Settlement::with('city','city.entity')->get()->toArray();

        $SameZipCodeSettlements = [];
        foreach($settlements as $settlement)
        {
            $zip_code = $settlement['zip_code'];
            if($this->last_zip_code!==$zip_code && $this->last_zip_code!==0) {
                Cache::rememberForever($zip_code, function() use($SameZipCodeSettlements) {
                    return $SameZipCodeSettlements;
                });
                $SameZipCodeSettlements = [];
                $this->info($zip_code);
            } else {
                $SameZipCodeSettlements[] = $settlement;
            }
            $this->last_zip_code = $zip_code;
        }
        $this->info("Finalizado proceso de Cache");
    }
*/
    public function handle()
    {
        $this->info("Iniciando proceso de Cache");
        $settlements = Settlement::distinct()->get(['zip_code']);
        foreach($settlements as $settlement)
        {
            $zip_code = $settlement['zip_code'];
            $this->info($zip_code);
            Cache::rememberForever($settlement['zip_code'], function() use($zip_code) {
                return Settlement::with('city','city.entity')->where('zip_code', $zip_code)->get()->toArray();
            });
        }

    }
}
