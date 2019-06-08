<?php

namespace Unit\DogWalker\Domain\Entity;

use DogWalker\Domain\Entity\Dog;
use PHPUnit\Framework\TestCase;

class DogTest extends TestCase
{
    public function test_is_able_to_create_dog_entity()
    {
        $uuid = 'fake-uuid';
        $owner = 'Jaimie';
        $name = 'Toby';
        $breed = 'Greyhound';
        $age = 4;

        $sut = Dog::create($uuid, $owner, $name, $breed, $age);

        $this->assertEquals($uuid, $sut->getUuid());
    }
}