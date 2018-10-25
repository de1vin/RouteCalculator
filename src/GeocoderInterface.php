<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator;

use de1vin\RouteCalculator\Coordinates\Coordinate;


interface GeocoderInterface
{
    /**
     * @param string $address
     * @return Coordinate
     */
    public function coordinate(string $address): Coordinate;
}
