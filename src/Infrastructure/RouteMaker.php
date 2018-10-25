<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure;

use de1vin\RouteCalculator\Coordinates\Coordinate;
use de1vin\RouteCalculator\Infrastructure\Persistence\FetchDistanceInterface;
use de1vin\RouteCalculator\Infrastructure\Persistence\FetchDistanceOSRM;
use de1vin\RouteCalculator\RouteMakerInterface;
use de1vin\RouteCalculator\Routes\Route;


class RouteMaker implements RouteMakerInterface
{
    public $fetchClass = FetchDistanceOSRM::class;


    public function route(Coordinate $from, Coordinate $to): Route
    {
        /** @var FetchDistanceInterface $fetch */
        $fetch = new $this->fetchClass;
        $response = $fetch->fetch($from, $to);
        $distance = (float)$response['routes'][0]["distance"];
        $route = new Route($from, $to, $distance);

        return $route;
    }
}
