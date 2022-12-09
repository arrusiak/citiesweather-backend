<?php

namespace App\Interface;

interface GooglePlacesApiInterface{
    public function getLocation(string $input): array;
    public function formatPredictions(array $predictions): array;
}
