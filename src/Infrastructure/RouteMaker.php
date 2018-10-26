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
    /** @var FetchDistanceInterface|string */
    public $fetchClass = FetchDistanceOSRM::class;


    public function route(Coordinate $from, Coordinate $to): Route
    {
        if (is_string($this->fetchClass)) {
            $this->fetchClass = new $this->fetchClass;
        }
        $distance = $this->fetchClass->fetch($from, $to);
        $route = new Route($from, $to, $distance);

        return $route;
    }
}
