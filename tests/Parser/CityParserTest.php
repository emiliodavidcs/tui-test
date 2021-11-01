<?php

namespace Emilioclemente\TuiApp\Tests\Parser;

use Emilioclemente\TuiApp\DTO\CityDto;
use Emilioclemente\TuiApp\Parser\CityParser;
use PHPUnit\Framework\TestCase;

class CityParserTest extends TestCase
{
    private static function getMockCityData()
    {
        return [
            'name' => 'Mock City',
            'latitude' => rand(),
            'longitude' => rand(),
        ];
    }

    public function testParseCity()
    {
        // arrange
        $mockCityData = self::getMockCityData();

        $parser = new CityParser();

        // act
        $res = $parser->parseCity($mockCityData);

        // assert
        self::isInstanceOf(CityDto::class, $res);
        self::assertEquals($mockCityData['name'], $res->getName());
        self::assertEquals($mockCityData['latitude'], $res->getLatitude());
        self::assertEquals($mockCityData['longitude'], $res->getLongitude());
    }

    public function testParseCities()
    {
        // arrange
        $mockCitiesData = [
            self::getMockCityData(),
        ];

        $parser = new CityParser();

        // act
        $res = $parser->parseCities($mockCitiesData);

        // assert
        self::assertIsArray($res);
        self::assertCount(1, $res);
        self::assertEquals($mockCitiesData[0]['name'], $res[0]->getName());
        self::assertEquals($mockCitiesData[0]['latitude'], $res[0]->getLatitude());
        self::assertEquals($mockCitiesData[0]['longitude'], $res[0]->getLongitude());
    }
}