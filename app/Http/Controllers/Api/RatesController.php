<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConvertRequest;
use App\Http\Resources\RateConvertResource;
use App\Http\Resources\RateResource;
use App\Models\RateConvert;
use App\Services\RatesService;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    private $ratesService;

    public function __construct(Request $request, RatesService $ratesService)
    {
        $this->ratesService = $ratesService;
    }

    public function filter(Request $request)
    {
        if (! $request->filter) {
            return RateResource::collection($this->ratesService->rates());
        }


        return new RateResource($this->ratesService->filter());
    }

    public function convert(ConvertRequest $request)
    {
        $convertData = $this->ratesService->convert($request->currency_from,  $request->currency_to, $request->value);

        $rateConvert = RateConvert::create([
            'currency_from' => $request->currency_from,
            'currency_to' => $request->currency_to,
            'value' => $request->value,
            'converted_value'=> $convertData['convertedValue'],
            'rate'=> $convertData['convertRate'],
        ]);

        return new RateConvertResource($rateConvert);
    }
}
