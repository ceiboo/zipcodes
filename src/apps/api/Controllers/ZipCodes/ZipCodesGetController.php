<?php

declare(strict_types = 1);

namespace Ceiboo\Api\Controllers\ZipCodes;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ceiboo\Modules\Geo\Controllers\GetZipCodeByCriteria;

final class ZipCodesGetController
{

    private $getZipCodeByCriteria;

    public function __construct(GetZipCodeByCriteria $getZipCodeByCriteria)
    {
        $this->getZipCodeByCriteria = $getZipCodeByCriteria;
    }

    public function __invoke(Request $request): Response
    {
        $response = $this->getZipCodeByCriteria->__invoke($request);

        return new Response($response['data'],$response['code']);
    }
}
