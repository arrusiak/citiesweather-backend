<?php

namespace App\Http\Controllers;

use App\Interface\GooglePlacesApiInterface;
use App\Services\Api\GooglePlacesApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Exception;

class SearchController extends Controller
{
    public $googlePlacesApiService;

    public function __construct(GooglePlacesApiInterface $googlePlacesApiService)
    {
        $this->googlePlacesApiService = $googlePlacesApiService;
    }

    /**
     * @throws InternalErrorException
     */
    public function search(Request $request): JsonResponse
    {
        //todo:validation
        $input = $request->input;

        try {
            $result = $this->googlePlacesApiService->getLocation($input);

            $formattedPredictions = $this->googlePlacesApiService->formatPredictions($result['predictions']);

            //todo: laravel resource

            return response()->json($formattedPredictions);

        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
