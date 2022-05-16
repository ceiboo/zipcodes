<?php

namespace Ceiboo\Modules\Geo\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ceiboo\Modules\Geo\Eloquent\Entity;

class City extends Model
{
    use SoftDeletes;

    protected $table = 'geo_cities';
    protected $primaryKey = 'id';

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

}
