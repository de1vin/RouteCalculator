<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Routes;

use de1vin\RouteCalculator\Coordinates\Coordinate;


class Route
{
    private $from;
    private $to;
    private $distance;

    /**
     * Route constructor.
     * @param Coordinate $from
     * @param Coordinate $to
     * @param float $distance
     */
    public function __construct(Coordinate $from, Coordinate $to, float $distance)
    {
        $this->from = $from;
        $this->to = $to;
        $this->distance = $distance;
    }

    /**
     * @return Coordinate
     */
    public function getFrom(): Coordinate
    {
        return $this->from;
    }

    /**
     * @return Coordinate
     */
    public function getTo(): Coordinate
    {
        return $this->to;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }
}
