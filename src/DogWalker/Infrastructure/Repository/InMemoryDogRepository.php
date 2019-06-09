<?php

namespace DogWalker\Infrastructure\Repository;

use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\Repository\DogRepository;
use DogWalker\Infrastructure\Exception\EntityNotFoundException;
use DogWalker\Infrastructure\Repository\Traits\DogTrait;

class InMemoryDogRepository implements DogRepository
{
    use DogTrait;

    private $memory = [];

    public function __construct()
    {
        $this->save($this->createValidDog());
    }

    public function save(Dog $dog): void
    {
        $this->memory[$dog->getId()] = $dog;
    }

    public function findById(string $id): Dog
    {
        if (!isset($this->memory[$id])) {
            throw new EntityNotFoundException(Dog::class, $id);
        }

        return $this->memory[$id];
    }

    public function findAll(): array
    {
        return $this->memory;
    }
}
