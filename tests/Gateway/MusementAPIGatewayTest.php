<?php

namespace Emilioclemente\TuiApp\Tests\Gateway;

use Emilioclemente\TuiApp\Gateway\HttpClient;
use Emilioclemente\TuiApp\Gateway\MusementAPIGateway;
use PHPUnit\Framework\TestCase;

class MusementAPIGatewayTest extends TestCase
{
    public function testGetCities(): void
    {
        // arrange
        $mockCity = ['name' => 'Mock City'];
        $httpClient = self::createMock(HttpClient::class);
        $httpClient->expects(self::once())->method('get')->willReturn([$mockCity]);
        $gateway = new MusementAPIGateway($httpClient);

        // act
        $res = $gateway->getCities();

        // assert
        self::assertEquals($mockCity['name'], $res[0]['name']);
    }
}
