<?php

require 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Emilioclemente\TuiApp\Gateway\MusementAPIGateway;
use Emilioclemente\TuiApp\Gateway\WeatherAPIGateway;
use Emilioclemente\TuiApp\Parser\CityParser;
use Symfony\Component\DependencyInjection\Reference;
use Emilioclemente\TuiApp\Gateway\HttpClient;

// SERVICES DEFINITION
// TODO: this should be moved to a "services definition file"
$containerBuilder = new ContainerBuilder();
$containerBuilder->register('http_client', HttpClient::class);

$musementGateway = $containerBuilder
    ->register('gateway.musement_api', MusementAPIGateway::class)
    ->addArgument(new Reference('http_client'));
$weatherGateway = $containerBuilder
    ->register('gateway.weather_api', WeatherAPIGateway::class)
    ->addArgument(new Reference('http_client'));
$cityParser = $containerBuilder->register('parser.city', CityParser::class);

// SERVICES RETRIEVAL
$musementGateway = $containerBuilder->get('gateway.musement_api');
$weatherGateway = $containerBuilder->get('gateway.weather_api');
$cityParser = $containerBuilder->get('parser.city');

// APP
$citiesData = $musementGateway->getCities();
$cities = $cityParser->parseCities($citiesData);

foreach ($cities as $city) {
    $forecastData = $weatherGateway->getForecast($city->getLatitude(), $city->getLongitude());
    echo sprintf(
        "Processed city %s | %s - %s \n",
        $city->getName(),
        $forecastData['forecast']['forecastday'][0]['day']['condition']['text'],
        $forecastData['forecast']['forecastday'][1]['day']['condition']['text']
    );
}
