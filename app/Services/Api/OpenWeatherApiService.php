<?php

namespace App\Services\Api;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class OpenWeatherApiService
{
    public function getWeather(string $city)
    {
        Log::info('Start request to openWeatherApi', ['city' => $city]);
        try {
            $response = $this->prepare()->get("forecast/daily", [
                'q' => $city,
                'cnt' => config('openweatherapi.days'),
                'appid' => config('openweatherapi.api_key'),
                'units' => config('openweatherapi.units')
            ])->throw()->json();

            Log::info('Finish request to openWeatherApi', ['city' => $city, 'response' => $response]);

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
        return Http::baseUrl(config('openweatherapi.base_url'));
    }
}
