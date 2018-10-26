<?php

namespace de1vin\RouteCalculator\Infrastructure\Persistence;


use maxh\Nominatim\Nominatim;

class FetchCoordinatesNominatim implements FetchCoordinatesInterface
{
    private $nominatim;

    public function __construct()
    {
        $url = 'http://nominatim.openstreetmap.org/';
        $this->nominatim = new Nominatim($url);
    }

    public function fetch(string $address): CoordinateDto
    {
        $search = $this->nominatim->newSearch();
        $search->query($address)->limit(1);
        $response = $this->nominatim->find($search);
        $result = \current($response);
        $coordinate = new CoordinateDto((float)$result['lat'], (float)$result['lon']);
        return $coordinate;
    }
}
