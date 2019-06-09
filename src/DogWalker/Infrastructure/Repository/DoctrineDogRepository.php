<?php

namespace DogWalker\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\Repository\DogRepository;
use SharedKernel\Domain\Exception\DomainEntityNotFoundException;

class DoctrineDogRepository extends ServiceEntityRepository implements DogRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dog::class);
    }

    public function save(Dog $dog): void
    {
        $this->_em->persist($dog);
        $this->_em->flush();
    }

    public function findById(string $id): Dog
    {
        $dog = $this->_em->find(Dog::class, $id);
        if (!$dog || !$dog instanceof Dog) {
            throw new DomainEntityNotFoundException(Dog::class . ' id: ' . $id);
        }

        return $dog;
    }

    public function findAll()
    {
        return parent::findAll();
    }
}
