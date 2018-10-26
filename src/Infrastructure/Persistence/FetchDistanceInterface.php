<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure\Persistence;

use de1vin\RouteCalculator\Coordinates\Coordinate;

interface FetchDistanceInterface
{
    public function fetch(Coordinate $from, Coordinate $to): float;
}
