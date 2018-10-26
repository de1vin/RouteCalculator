<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure;

use de1vin\RouteCalculator\Coordinates\Coordinate;
use de1vin\RouteCalculator\GeocoderInterface;
use de1vin\RouteCalculator\Infrastructure\Persistence\CoordinateDto;
use de1vin\RouteCalculator\Infrastructure\Persistence\FetchCoordinatesInterface;
use de1vin\RouteCalculator\Infrastructure\Persistence\FetchCoordinatesNominatim;


class Geocoder implements GeocoderInterface
{
    /**
     * @var FetchCoordinatesInterface|string
     */
    public $fetchClass = FetchCoordinatesNominatim::class;

    public function coordinate(string $address): Coordinate
    {
        $response = $this->fetch($address);
        $coordinates = new Coordinate($response->latitude, $response->longitude, $address);
        return $coordinates;
    }

    private function fetch(string $address): CoordinateDto
    {
        if (is_string($this->fetchClass)) {
            $this->fetchClass = new $this->fetchClass;
        }

        return $this->fetchClass->fetch($address);
    }
}
