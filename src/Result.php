<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator;



use de1vin\RouteCalculator\Routes\RoutesCollection;

class Result implements ResultInterface
{
    private $routes;
    private $distance;

    /**
     * Result constructor.
     * @param RoutesCollection $routes
     */
    public function __construct(RoutesCollection $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return RoutesCollection
     */
    public function routes(): RoutesCollection
    {
        return $this->routes;
    }

    /**
     * @return float
     */
    public function distance(): float
    {
        if ($this->distance === null) {
            $this->distance = $this->calculatedistance();
        }

        return $this->distance;
    }

    /**
     * @return float
     */
    private function calculatedistance(): float
    {
        $distance = 0;

        foreach ($this->routes as $route) {
            $distance += $route->getDistance();
        }

        return $distance;
    }
}
