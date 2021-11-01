<?php

namespace Emilioclemente\TuiApp\Gateway;

use Emilioclemente\TuiApp\Constants\WeatherAPIConstants;

class WeatherAPIGateway
{
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function getForecast(float $latitude, float $longitude, int $days = 2)
    {
        return $this->client->get(
            WeatherAPIConstants::BASE_URL.WeatherAPIConstants::ENDPOINT_FORECAST,
            [
                'key' => getenv('WEATHER_API_KEY'),
                'q' => sprintf('%f,%f', $latitude, $longitude),
                'days' => $days,
            ]
        );
    }
}
