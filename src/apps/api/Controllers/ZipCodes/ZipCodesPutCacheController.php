<?php

declare(strict_types = 1);

namespace Ceiboo\Api\Controllers\ZipCodes;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ceiboo\Modules\Geo\Controllers\PutCacheZipCode;

final class ZipCodesPutCacheController
{

    private $putCacheZipCode;

    public function __construct(PutCacheZipCode $putCacheZipCode)
    {
        $this->putCacheZipCode = $putCacheZipCode;
    }

    public function __invoke(Request $request): Response
    {
        $response = $this->putCacheZipCode->__invoke($request);

        return new Response($response['data'],$response['code']);
    }
}
