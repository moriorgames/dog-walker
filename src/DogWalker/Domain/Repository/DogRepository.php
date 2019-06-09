<?php

namespace DogWalker\Domain\Repository;

use DogWalker\Domain\Entity\Dog;

interface DogRepository
{
    public function save(Dog $dog): void;

    public function findById(string $id): Dog;

    public function findAll();
}
