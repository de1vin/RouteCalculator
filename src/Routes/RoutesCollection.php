<?php
declare(strict_types = 1);

namespace de1vin\RouteCalculator\Routes;


class RoutesCollection implements \Countable, \Iterator
{
    private $values = [];
    private $position = 0;

    public function __construct(Route ...$routes)
    {
        $this->values = $routes;
    }

    public function toArray(): array
    {
        return $this->values;
    }

    public function add(Route ...$coordinates): void
    {
        $this->values = array_merge($this->values, $coordinates);
    }

    public function current(): Route
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
