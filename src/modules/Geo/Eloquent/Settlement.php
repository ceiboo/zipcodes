<?php

namespace Ceiboo\Modules\Geo\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ceiboo\Modules\Geo\Eloquent\City;

class Settlement extends Model
{
    use SoftDeletes;

    protected $table = 'geo_settlements';
    protected $primaryKey = 'id';

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
