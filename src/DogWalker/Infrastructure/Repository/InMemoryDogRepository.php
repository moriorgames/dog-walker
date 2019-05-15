<?php

namespace DogWalker\Infrastructure\Repository;

use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\Repository\DogRepository;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class InMemoryDogRepository implements DogRepository
{
    private $memory = [];

    public function __construct()
    {
        $this->save($this->generateValidInstanceOfDog());
    }

    public function save(Dog $dog): Dog
    {
        $this->memory[$dog->getUuid()] = $dog;

        return $dog;
    }

    public function findById(string $id): Dog
    {
        if (!isset($this->memory[$id])) {
            throw new ResourceNotFoundException('Resource Model Not found');
        }

        return $this->memory[$id];
    }

    public function findAll(): array
    {
        return $this->memory;
    }

    private function generateValidInstanceOfDog(): Dog
    {
        $uuid = 'fake-dog-uuid';
        $owner = 'fake-owner-uuid';
        $name = 'Lua';
        $breed = 'greyhound';
        $age = 2;

        return Dog::create($uuid, $owner, $name, $breed, $age);
    }
}
