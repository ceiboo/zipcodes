<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->namespace('Ceiboo\Api\Controllers')->group(function () {
    Route::get('status', 'Status\StatusGetController');

    Route::get('zip-codes/{zip_code}', 'ZipCodes\ZipCodesGetController');
    Route::put('zip-codes-cache/', 'ZipCodes\ZipCodesPutCacheController');
});
