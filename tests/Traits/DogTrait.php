<?php

namespace Traits;

use DogWalker\Domain\Entity\Dog;

trait DogTrait
{
    protected function createValidDog(): Dog
    {
        $uuid = 'fake-dog-uuid';
        $owner = 'fake-owner-uuid';
        $name = 'Lua';
        $breed = 'greyhound';
        $age = 2;

        return Dog::create($uuid, $owner, $name, $breed, $age);
    }
}
