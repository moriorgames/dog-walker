<?php

namespace Unit\DogWalker\Domain\Entity;

use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\ValueObject\DogId;
use PHPUnit\Framework\TestCase;

class DogTest extends TestCase
{
    public function test_is_able_to_create_dog_entity()
    {
        $uuid = '9733eaed-4a7a-4dd6-ac2a-d3cf5feddccd';
        $owner = 'Jaimie';
        $name = 'Toby';
        $breed = 'Greyhound';
        $age = 4;

        $sut = Dog::create(new DogId($uuid), $owner, $name, $breed, $age);

        $this->assertEquals($uuid, $sut->getId());
    }

    public function test_throws_domain_exception_when_id_is_not_valid_uuid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $uuid = 'fake-uuid';
        $owner = 'Jaimie';
        $name = 'Toby';
        $breed = 'Greyhound';
        $age = 4;

        $sut = Dog::create(new DogId($uuid), $owner, $name, $breed, $age);

        $this->assertEquals($uuid, $sut->getId());
    }
}
