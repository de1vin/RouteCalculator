<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator;

use de1vin\RouteCalculator\Coordinates\CoordinatesCollection;
use de1vin\RouteCalculator\Exceptions\SmallNumberRoutersException;
use de1vin\RouteCalculator\Routes\RoutesCollection;
use Psr\SimpleCache\CacheInterface;

class Calculator
{
    public $resultClassName = Result::class;
    private $geocoder;
    private $routeMaker;
    private $cache;

    public function __construct(GeocoderInterface $geocoder, RouteMakerInterface $routeMaker, CacheInterface $cache)
    {
        $this->geocoder = $geocoder;
        $this->routeMaker = $routeMaker;
        $this->cache = $cache;
    }

    /**
     * @param string ...$addresses
     * @return ResultInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function calculate(string ...$addresses): ResultInterface
    {
        $key = 'addresses_' . md5(implode(';', $addresses));
        $routes = $this->cache->get($key);

        if ($routes === null) {
            $coordinates = $this->getCoordinates($addresses);
            $routes = $this->getRoutes($coordinates);
            $this->cache->set($key, $routes);
        }

        return new $this->resultClassName($routes);
    }


    private function getCoordinates(array $addresses): CoordinatesCollection
    {
        $coordinates = [];

        foreach ($addresses as $address) {
            $key = 'coordinate_' . md5($address);
            $coordinate = $this->cache->get($key);
            if ($coordinate === null) {
                $coordinate = $this->geocoder->coordinate($address);
                $this->cache->set($key, $coordinate);
            }

            $coordinates[] = $this->geocoder->coordinate($address);
        }

        return new CoordinatesCollection(...$coordinates);
    }

    private function getRoutes(CoordinatesCollection $coordinates): RoutesCollection
    {
        $routes = [];
        $count = \count($coordinates);

        if ($count < 2) {
            throw new SmallNumberRoutersException('Coordinates must be greater than one.');
        }

        while ($coordinates->valid())
        {
            $fromCoordinate = $coordinates->current();
            $coordinates->next();
            $toCoordinate = $coordinates->current();
            $coordinates->next();

            if ($toCoordinate) {
                $routes[] = $this->routeMaker->route($fromCoordinate, $toCoordinate);
            }
        }

        return new RoutesCollection(...$routes);
    }
}
