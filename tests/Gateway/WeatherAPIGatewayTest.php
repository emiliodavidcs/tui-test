<?php

namespace Emilioclemente\TuiApp\Tests\Gateway;

use Emilioclemente\TuiApp\Gateway\HttpClient;
use Emilioclemente\TuiApp\Gateway\WeatherAPIGateway;
use PHPUnit\Framework\TestCase;
use DateTime;

class WeatherAPIGatewayTest extends TestCase
{
    public function testGetForecast(){
        // arrange
        $currentDate = new DateTime();

        $mockForecast = [
            'forecast' => [
                'forecastday' => [
                    $currentDate->format('Y-m-d') => [
                        'day' => [
                            'condition' => [
                                'text' => 'Sunny'
                            ]
                        ]
                    ],
                    $currentDate->modify('+1d')->format('Y-m-d') => [
                        'day' => [
                            'condition' => [
                                'text' => 'Cloudy'
                            ]
                        ]
                    ],
                ]
            ]
        ];

        $httpClient = self::createMock(HttpClient::class);
        $httpClient->expects(self::once())->method('get')->willReturn([$mockForecast]);
        $gateway = new WeatherAPIGateway($httpClient);

        // act
        $res = $gateway->getForecast(rand(), rand(), 2);

        // assert
        self::assertEquals(
            $mockForecast['forecast']['forecastday'][0]['day']['condition']['text'],
            $res['forecast']['forecastday'][0]['day']['condition']['text']
        );
        self::assertEquals(
            $mockForecast['forecast']['forecastday'][1]['day']['condition']['text'],
            $res['forecast']['forecastday'][1]['day']['condition']['text']
        );
    }
}