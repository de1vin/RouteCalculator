<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure\Persistence;

interface FetchCoordinatesInterface
{
    public function fetch(string $address): array;
}
