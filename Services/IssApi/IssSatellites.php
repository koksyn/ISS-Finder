<?php

namespace Services\IssApi;

use Engine\DTO\DTOBuilder;
use Models\DTO\Iss\Satellite;

class IssSatellites
{
    /** @var IssApiAdapter $issApiAdapter */
    private $issApiAdapter;

    /**
     * @param IssApiAdapter $issApiAdapter
     */
    public function __construct(IssApiAdapter $issApiAdapter)
    {
        $issApiAdapter->init('satellites');
        $this->issApiAdapter = $issApiAdapter;
    }

    /**
     * @return Satellite
     * @throws \Exception
     */
    public function getFirstAvailable()
    {
        /** @var Satellite[] $satelliteCollection */
        $satelliteCollection = $this->getCollection();

        if(empty($satelliteCollection)) {
            throw new \Exception('ISS Satellite not found!');
        }

        /** @var Satellite $fragmented */
        $fragmented = array_shift($satelliteCollection);
        /** @var integer $id */
        $id = $fragmented->getId();

        return $this->getOneById($id);
    }

    /**
     * @return Satellite[]
     */
    public function getCollection()
    {
        /** @var \stdClass[] $objectCollection */
        $objectCollection = $this->issApiAdapter->get();

        /** @var Satellite[] $satelliteCollection */
        $satelliteCollection = DTOBuilder::buildCollection(Satellite::class, $objectCollection);

        return $satelliteCollection;
    }

    /**
     * @param string|int $id
     * @return Satellite
     */
    public function getOneById($id)
    {
        /** @var \stdClass $object */
        $object = $this->issApiAdapter->get($id);

        /** @var Satellite $satellite */
        $satellite = DTOBuilder::build(Satellite::class, $object);

        return $satellite;
    }
}