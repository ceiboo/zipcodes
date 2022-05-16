<?php

namespace Ceiboo\Modules\Geo\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ceiboo\Modules\Geo\Eloquent\City;

class Entity extends Model
{
    use SoftDeletes;

    protected $table = 'geo_entities';
    protected $primaryKey = 'id';

}
