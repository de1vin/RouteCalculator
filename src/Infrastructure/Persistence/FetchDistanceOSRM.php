<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure\Persistence;


use de1vin\RouteCalculator\Coordinates\Coordinate;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FetchDistanceOSRM implements FetchDistanceInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetch(Coordinate $from, Coordinate $to): array
    {
        $url = sprintf(
            'http://router.project-osrm.org/route/v1/car/%s,%s;%s,%s?overview=false&',
            $from->getLatitude(), $from->getLongitude(),
            $to->getLatitude(), $to->getLongitude()
        );
        $requiest = new Request('GET', $url);
        $response = $this->client->send($requiest);
        $result = \json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
