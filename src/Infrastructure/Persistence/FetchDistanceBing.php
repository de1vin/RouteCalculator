<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure\Persistence;


use de1vin\RouteCalculator\Coordinates\Coordinate;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FetchDistanceBing implements FetchDistanceInterface
{
    private $client;
    private $key;

    public function __construct(string $key)
    {
        $this->client = new Client();
        $this->key = $key;
    }

    public function fetch(Coordinate $from, Coordinate $to): float
    {
        $url = sprintf(
            'https://dev.virtualearth.net/REST/v1/Routes/Truck?wp.0=%s&wp.1=%s&du=km&key=%s',
            (string)$from,
            (string)$to,
            $this->key
        );
        $requiest = new Request('GET', $url);
        $response = $this->client->send($requiest);
        $result = \json_decode($response->getBody()->getContents(), true);
        $result = (float)$result['resourceSets'][0]['resources'][0]['travelDistance'];
        return $result;
    }
}
