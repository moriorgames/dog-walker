<?php

namespace DogWalker\Domain\Repository;

use DogWalker\Domain\Entity\Dog;

interface DogRepository
{
    public function save(Dog $dog): Dog;

    public function findById(string $id): Dog;
}
