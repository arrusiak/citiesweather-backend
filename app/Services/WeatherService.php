<?php

namespace App\Services;

use App\Models\Weather;
use App\Services\Api\OpenWeatherApiService;
use Carbon\Carbon;

class WeatherService
{
    public $openWeatherApiService;

    public function __construct(OpenWeatherApiService $openWeatherApiService)
    {
        $this->openWeatherApiService = $openWeatherApiService;
    }


    public function getAll()
    {
        return Weather::all();
    }

    public function getWeatherByCity(string $city): array
    {
        $response = $this->openWeatherApiService->getWeather($city);

        $this->deleteWeatherByCity($city);

        return array_reduce($response['list'], function ($result, $item) use ($response) {
            $temp = $item['temp'];
            $description = reset($item['weather']);

            $weather = new Weather();

            $weather->city = $response['city']['name'];
            $weather->country = $response['city']['country'];
            $weather->day = $temp['day'];
            $weather->evening = $temp['eve'];
            $weather->morning = $temp['morn'];
            $weather->night = $temp['night'];
            $weather->description = $description['description'];
            $weather->icon = $description['icon'];
            $weather->date =  Carbon::createFromTimestamp($item['dt']);

            $weather->save();
            $result[] = $weather;

            return $result;
        }, []);
    }

    private function deleteWeatherByCity(string $city): void
    {
        Weather::where('city', $city)->delete();
    }
}
