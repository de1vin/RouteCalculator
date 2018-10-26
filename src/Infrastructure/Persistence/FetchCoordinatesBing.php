<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Infrastructure\Persistence;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FetchCoordinatesBing implements FetchCoordinatesInterface
{
    private $client;
    private $key;

    public function __construct(string $key)
    {
        $this->client = new Client();
        $this->key = $key;
    }

    public function fetch(string $address): CoordinateDto
    {
        $url = sprintf(
            'http://dev.virtualearth.net/REST/v1/Locations/%s?maxResults=1&key=%s',
            $address,
            $this->key
        );
        $request = new Request('GET', $url);
        $response = $this->client->send($request);
        $result = \json_decode($response->getBody()->getContents(), true);
        $result = $result['resourceSets'][0]['resources'][0]['geocodePoints'][0]['coordinates'];
        $coordinates = new CoordinateDto((float)$result[0], (float)$result[1]);

        return $coordinates;
    }
}
