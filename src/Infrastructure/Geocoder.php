<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure;

use de1vin\RouteCalculator\Coordinates\Coordinate;
use de1vin\RouteCalculator\GeocoderInterface;
use de1vin\RouteCalculator\Infrastructure\Persistence\FetchCoordinatesInterface;
use de1vin\RouteCalculator\Infrastructure\Persistence\FetchCoordinatesNominatim;


class Geocoder implements GeocoderInterface
{
    public $fetchClass = FetchCoordinatesNominatim::class;

    public function coordinate(string $address): Coordinate
    {
        $response = $this->fetch($address);
        $coordinates = new Coordinate((float)$response['lat'], (float)$response['lon'], $address);
        return $coordinates;
    }

    private function fetch(string $address): array
    {
        /** @var FetchCoordinatesInterface $fetch */
        $fetch = new $this->fetchClass;
        return $fetch->fetch($address);
    }
}
