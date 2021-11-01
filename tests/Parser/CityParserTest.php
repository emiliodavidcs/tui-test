<?php

namespace Emilioclemente\TuiApp\Tests\Parser;

use Emilioclemente\TuiApp\DTO\CityDto;
use Emilioclemente\TuiApp\Parser\CityParser;
use PHPUnit\Framework\TestCase;

class CityParserTest extends TestCase
{
    /**
     * @return array<string, mixed>
     */
    private static function getMockCityData(): array
    {
        return [
            'name' => 'Mock City',
            'latitude' => rand(),
            'longitude' => rand(),
        ];
    }

    public function testParseCity(): void
    {
        // arrange
        $mockCityData = self::getMockCityData();

        $parser = new CityParser();

        // act
        $res = $parser->parseCity($mockCityData);

        // assert
        self::assertInstanceOf(CityDto::class, $res);
        self::assertEquals($mockCityData['name'], $res->getName());
        self::assertEquals($mockCityData['latitude'], $res->getLatitude());
        self::assertEquals($mockCityData['longitude'], $res->getLongitude());
    }

    public function testParseCities(): void
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
        self::assertInstanceOf(CityDto::class, $res[0]);
        self::assertEquals($mockCitiesData[0]['name'], $res[0]->getName());
        self::assertEquals($mockCitiesData[0]['latitude'], $res[0]->getLatitude());
        self::assertEquals($mockCitiesData[0]['longitude'], $res[0]->getLongitude());
    }
}
