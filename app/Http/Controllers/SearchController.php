<?php

namespace App\Http\Controllers;

use App\Services\Api\GooglePlacesApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Exception;

class SearchController extends Controller
{
    public $googlePlacesApiService;

    public function __construct(GooglePlacesApiService $googlePlacesApiService)
    {
        $this->googlePlacesApiService = $googlePlacesApiService;
    }

    /**
     * @throws InternalErrorException
     */
    public function search(Request $request): JsonResponse
    {
        $input = $request->input;

        try {
            $result = $this->googlePlacesApiService->getLocation($input);

            $formattedPredictions = $this->googlePlacesApiService->formatPredictions($result['predictions']);

            return response()->json($formattedPredictions);
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
