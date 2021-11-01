<?php

namespace Emilioclemente\TuiApp\Parser;

use Emilioclemente\TuiApp\DTO\CityDto;

class CityParser
{
    /**
     * @param array<string, mixed> $cityData
     * @return CityDto
     */
    public function parseCity(array $cityData): CityDto
    {
        return new CityDto(
            $cityData['name'],
            $cityData['latitude'],
            $cityData['longitude']
        );
    }

    /**
     * @param array<int, array<string, mixed>>  $citiesData
     * @return array<CityDto>
     */
    public function parseCities(array $citiesData): array
    {
        $cities = [];

        foreach ($citiesData as $cityData) {
            $cities[] = $this->parseCity($cityData);
        }

        return $cities;
    }
}
