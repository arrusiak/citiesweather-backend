<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class WeatherController extends Controller
{
    public $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @throws InternalErrorException
     */
    public function getAll(): JsonResponse
    {
        try {
            $weather = $this->weatherService->getAll();

            return response()->json($weather);
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }

    /**
     * @throws InternalErrorException
     */
    public function getWeather(string $city): JsonResponse
    {
        try {
            $weather = $this->weatherService->getWeatherByCity($city);

            return response()->json($weather);
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
