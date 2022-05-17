<?php

namespace Ceiboo\Modules\Geo\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZipCode extends Model
{
    use SoftDeletes;

    protected $table = 'geo_zipcode';
    protected $primaryKey = 'id';

}
