<?php

namespace Emilioclemente\TuiApp\Gateway;

use Emilioclemente\TuiApp\Constants\WeatherAPIConstants;

class WeatherAPIGateway
{
    private HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return array<string, mixed>
     */
    public function getForecast(float $latitude, float $longitude, int $days = 2): array
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
