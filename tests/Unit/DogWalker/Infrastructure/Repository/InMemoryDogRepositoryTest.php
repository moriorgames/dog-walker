<?php

namespace Unit\DogWalker\Infrastructure\Repository;

use DogWalker\Infrastructure\Exception\EntityNotFoundException;
use DogWalker\Infrastructure\Repository\InMemoryDogRepository;
use DogWalker\Infrastructure\Repository\Traits\DogTrait;
use PHPUnit\Framework\TestCase;

class InMemoryDogRepositoryTest extends TestCase
{
    use DogTrait;

    /** @var InMemoryDogRepository */
    private $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new InMemoryDogRepository;
    }

    public function test_is_able_to_save_dog_entity()
    {
        $dog = $this->createValidDog();

        $this->sut->save($dog);

        $this->assertCount(1, $this->sut->findAll());
    }

    public function test_is_throws_an_exception_when_entity_not_found()
    {
        $this->expectException(EntityNotFoundException::class);

        $this->sut->findById('entity-not-found');
    }

    public function test_is_able_find_dog_entity()
    {
        $dog = $this->createValidDog();
        $this->sut->save($dog);

        $result = $this->sut->findById($dog->getId());

        $this->assertEquals($dog, $result);
    }
}
