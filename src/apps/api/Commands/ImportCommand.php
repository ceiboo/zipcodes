<?php

namespace Ceiboo\Api\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Ceiboo\Modules\Geo\Eloquent\Entity;
use Ceiboo\Modules\Geo\Eloquent\City;
use Ceiboo\Modules\Geo\Eloquent\Settlement;
use Illuminate\Support\Str;

final class ImportCommand extends Command
{
    protected $signature = 'api:import';

    private $mysql_fields = [ 'settlement:zip_code' =>0,
            'settlement:name' =>1,
            'settlement:type_name' =>2,
            'city:name' =>3,
            'entity:name' =>4,
            'city:locality' =>5,
            'null:1' =>6,
            'entity:key' =>7,
            'null:2' =>8,
            'entity:code' =>9,
            'null:4' =>10,
            'city:key' =>11,
            'settlement:key' =>12,
            'settlement:zone_type' =>13,
            'null:5' =>14
            ];

    private $last_entity_key=0;
    private $last_city_key=0;
    private $last_entity_id=0;
    private $last_city_id=0;
    private $settlement_id=0;

    public function handle()
    {
        system('clear');
        $this->info("Iniciando proceso de Importacion");

        // Leer
        $file= base_path('src/modules/Geo/Database/Seeders/CPdescarga.txt');
        $fp = fopen($file, 'r');
        DB::transaction(function() use  ($fp) {
            $delimiter = "|";
            $x=0;
            while ( !feof($fp) )
            {
                $line = fgets($fp, 2048);
                $data = str_getcsv($line, $delimiter);
                if($x>1 && isset($data[0])) {
                    $this->saveEntity($data);
                    $this->saveCity($data);
                    $this->saveSettlement($data);
                    $this->info($data[0].' '.\utf8_encode($data[1]));
                }
                $x++;
            }
        },5);
        fclose($fp);
        $this->info("Proceso de Importancion Finalizado");
    }

    private function saveEntity($data)
    {
        if($data[$this->mysql_fields['entity:key']]!=$this->last_entity_key) {

            $this->last_entity_key = $data[$this->mysql_fields['entity:key']];
            $this->last_entity_id ++;

            $entity = new Entity();
            $entity->id     = $this->last_entity_id;
            $entity->key    = $this->last_entity_key;
            $entity->name   = $this->validField($data[$this->mysql_fields['entity:name']]);
            $entity->code   = $this->validField($data[$this->mysql_fields['entity:code']]);
            $entity->save();

        }
    }

    private function saveCity($data)
    {
        if($data[$this->mysql_fields['city:key']]!=$this->last_city_key) {

            $this->last_city_key = $data[$this->mysql_fields['city:key']];
            $this->last_city_id ++;

            $city = new City();
            $city->id           = $this->last_city_id;
            $city->entity_id    = $this->last_entity_id;
            $city->key          = $this->last_city_key;
            $city->name         = $this->validField($data[$this->mysql_fields['city:name']]);
            $city->locality     = $this->validField($data[$this->mysql_fields['city:locality']]);
            $city->save();

        }
    }

    private function saveSettlement($data)
    {
        $this->settlement_id++;

        $settlement = new Settlement();
        $settlement->id         = $this->settlement_id;
        $settlement->key        = $this->validField($data[$this->mysql_fields['settlement:key']]);
        $settlement->name       = $this->validField($data[$this->mysql_fields['settlement:name']]);
        $settlement->zip_code   = $this->validField($data[$this->mysql_fields['settlement:zip_code']]);
        $settlement->zone_type  = $this->validField($data[$this->mysql_fields['settlement:zone_type']]);
        $settlement->type       = $this->validField($data[$this->mysql_fields['settlement:type_name']], false);
        $settlement->city_id    = $this->last_city_id;
        $settlement->save();
    }

    private function validField($value, $transform=true)
    {
        if($value==='') {
            return null;
        }
        if(is_numeric($value)) {
            return $value;
        }

        return ($transform) ? \strtoupper(\str_replace(array('Á','á', 'É','é', 'Í','í', 'Ó','ó', 'Ú','ú', 'Ü','ü'),
		                                    array('A','a', 'E','e', 'I','i', 'O','o', 'U','u', 'U','u'),
                                            \utf8_encode($value))) : \utf8_encode($value);
    }
}
