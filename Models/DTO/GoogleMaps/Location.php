<?php

namespace Models\DTO\GoogleMaps;

class Location
{
    /** @var AddressComponent[] $addressComponents */
    private $addressComponents;

    /** @var string $formattedAddress */
    private $formattedAddress;

    /** @var Geometry $geometry */
    private $geometry;

    /** @var boolean $partialMatch */
    private $partialMatch;

    /** @var string $placeId */
    private $placeId;

    /** @var array $types */
    private $types;

    /**
     * @return AddressComponent[]
     */
    public function getAddressComponents(): array
    {
        return $this->addressComponents;
    }

    /**
     * @param AddressComponent[] $addressComponents
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->addressComponents = $addressComponents;
    }

    /**
     * @return string
     */
    public function getFormattedAddress(): string
    {
        return $this->formattedAddress;
    }

    /**
     * @param string $formattedAddress
     */
    public function setFormattedAddress(string $formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * @return Geometry
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * @param Geometry $geometry
     */
    public function setGeometry(Geometry $geometry)
    {
        $this->geometry = $geometry;
    }

    /**
     * @return bool
     */
    public function isPartialMatch(): bool
    {
        return $this->partialMatch;
    }

    /**
     * @param bool $partialMatch
     */
    public function setPartialMatch(bool $partialMatch)
    {
        $this->partialMatch = $partialMatch;
    }

    /**
     * @return string
     */
    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    /**
     * @param string $placeId
     */
    public function setPlaceId(string $placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param array $types
     */
    public function setTypes(array $types)
    {
        $this->types = $types;
    }
}