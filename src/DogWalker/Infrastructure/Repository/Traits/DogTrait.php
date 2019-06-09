<?php

namespace DogWalker\Infrastructure\Repository\Traits;

use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\ValueObject\DogId;

trait DogTrait
{
    protected function createValidDog(): Dog
    {
        $uuid = '69b0fb62-99f5-48e1-8717-ced52a3f3088';
        $owner = 'fake-owner-uuid';
        $name = 'Lua';
        $breed = 'greyhound';
        $age = 2;

        return Dog::create(new DogId($uuid), $owner, $name, $breed, $age);
    }
}
