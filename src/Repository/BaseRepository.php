<?php

namespace App\Repository;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class BaseRepository
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var ObjectRepository
     */
    protected $objectRepository;

    public function __construct(ManagerRegistry $registry, Connection $connection)
    {
        $this->managerRegistry = $registry;
        $this->connection = $connection;
        $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    /**
     * Entity class.
     *
     * @return string
     */
    abstract protected function entityClass(): string;


    /**
     * Obtener el "Entity Manager" según la entidad.
     *
     * @return ObjectManager|null
     */
    private function getEntityManager(){
        $entityManager = $this->managerRegistry->getManagerForClass($this->entityClass());

        if($entityManager->isOpen()){
            return $entityManager;
        }

        return $this->managerRegistry->resetManager();
    }
}