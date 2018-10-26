<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Coordinates;

class Coordinate
{
    private $latitude;
    private $longitude;
    private $address;

    /**
     * Coordinates constructor.
     * @param float $latitude
     * @param float $longitude
     * @param string $address
     */
    public function __construct(float $latitude, float $longitude, string $address ='')
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->latitude . ',' . $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}
