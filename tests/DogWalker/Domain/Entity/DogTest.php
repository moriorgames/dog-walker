<?php

use DogWalker\Domain\Entity\Dog;
use PHPUnit\Framework\TestCase;

class DogTest extends TestCase
{
    public function test_is_able_to_create_dog_entity()
    {
        $uuid = 'fake-uuid';

        $sut = new Dog($uuid);

        $this->assertEquals($uuid, $sut->getUuid());
    }
}
