<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Coordinates;


class CoordinatesCollection implements \Countable, \Iterator
{
    private $values = [];
    private $position = 0;

    public function __construct(Coordinate ...$coordinates)
    {
        $this->values = $coordinates;
    }

    public function toArray(): array
    {
        return $this->values;
    }

    public function add(Coordinate ...$coordinates): void
    {
        $this->values = array_merge($this->values, $coordinates);
    }

    public function current(): Coordinate
    {
        return $this->values[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->values[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return \count($this->values);
    }
}
