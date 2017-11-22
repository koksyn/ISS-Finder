<?php

namespace Models\DTO\GoogleMaps;

class AddressComponent
{
    /** @var string $longName */
    private $longName;

    /** @var string $shortName */
    private $shortName;

    /** @var string[] $types */
    private $types;

    /**
     * @return string
     */
    public function getLongName(): string
    {
        return $this->longName;
    }

    /**
     * @param string $longName
     */
    public function setLongName(string $longName)
    {
        $this->longName = $longName;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return \string[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param \string[] $types
     */
    public function setTypes(array $types)
    {
        $this->types = $types;
    }
}