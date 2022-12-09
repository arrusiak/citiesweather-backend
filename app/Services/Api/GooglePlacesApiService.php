<?php

namespace App\Services\Api;

use App\Interface\GooglePlacesApiInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class GooglePlacesApiService implements GooglePlacesApiInterface
{
    /**
     * @param string $input
     * @return array
     */
    public function getLocation(string $input): array
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

    public function formatPredictions(array $predictions): array
    {
        return array_reduce($predictions, function ($result, $item) {
            $result[] = [
                "description" => $item['description'],
                "main_text" => $item['structured_formatting']['main_text'], //todo
                "secondary_text" => $item['structured_formatting']['secondary_text'],
            ];

            return $result;
        }, []);
    }
}
