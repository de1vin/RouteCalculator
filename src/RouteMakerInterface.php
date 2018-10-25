<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator;


use de1vin\RouteCalculator\Coordinates\Coordinate;
use de1vin\RouteCalculator\Routes\Route;

interface RouteMakerInterface
{
    /**
     * @param Coordinate $from
     * @param Coordinate $to
     * @return Route
     */
    public function route(Coordinate $from, Coordinate $to): Route;
}
