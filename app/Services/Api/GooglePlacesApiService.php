<?php

namespace App\Services\Api;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class GooglePlacesApiService
{
    public function getLocation(string $input)
    {
        Log::info('Start request to google places api', ['input' => $input]);
        try {
            $response = $this->prepare()->get("/place/autocomplete/json", [
                'input' => $input,
                'types' => '(cities)',
                'key' => config('googleplacesapi.api_key')
            ])->throw()->json();

            Log::info('Finish request to openWeatherApi', ['input' => $input, 'response' => $response]);

            return $response;
        } catch (Exception $e) {
            throw new BadRequestException();
        }
    }

    /**
     * @return PendingRequest
     */
    private function prepare(): PendingRequest
    {
        return Http::baseUrl(config('googleplacesapi.base_url'));
    }

    public function formatPredictions(array $predictions)
    {
        return array_reduce($predictions, function ($result, $item) {
            $result[] = [
                "description" => $item['description'],
                "main_text" => $item['structured_formatting']['main_text'],
                "secondary_text" => $item['structured_formatting']['secondary_text'],
            ];

            return $result;
        }, []);
    }
}
