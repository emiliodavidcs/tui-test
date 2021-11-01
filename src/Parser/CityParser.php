<?php

namespace Emilioclemente\TuiApp\Parser;

use Emilioclemente\TuiApp\DTO\CityDto;

class CityParser
{
    public function parseCity(array $cityData) {
        return new CityDto(
            $cityData['name'],
            $cityData['latitude'],
            $cityData['longitude']
        );
    }

    public function parseCities(array $citiesData) {
        $cities = [];

        foreach ($citiesData as $cityData) {
            $cities[] = $this->parseCity($cityData);
        }

        return $cities;
    }
}