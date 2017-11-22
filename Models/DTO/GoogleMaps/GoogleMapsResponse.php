<?php

namespace Models\DTO\GoogleMaps;

class GoogleMapsResponse
{
    /** @var Location[] $results */
    private $results;

    /** @var string $status */
    private $status;

    /**
     * @return Location[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Location[] $results
     */
    public function setResults(array $results)
    {
        $this->results = $results;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }
}