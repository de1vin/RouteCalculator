<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator;

use de1vin\RouteCalculator\Routes\RoutesCollection;


interface ResultInterface
{
    public function routes(): RoutesCollection;

    public function distance(): float;
}
