<?php

namespace DogWalker\Domain\Entity;

use DateTime;
use DogWalker\Domain\ValueObject\DogId;

class Dog
{
    /** @var string */
    private $id;
    /** @var string */
    private $owner;
    /** @var string */
    private $name;
    /** @var string */
    private $breed;
    /** @var int */
    private $age;
    /** @var DateTime */
    private $createdAt;
    /** @var DateTime */
    private $updatedAt;

    private function __construct(string $id, string $owner, string $name, string $breed, int $age)
    {
        $this->id = $id;
        $this->owner = $owner;
        $this->name = $name;
        $this->breed = $breed;
        $this->age = $age;
        $this->createdAt = new DateTime;
        $this->updatedAt = new DateTime;
    }

    public static function create(DogId $id, string $owner, string $name, string $breed, int $age): self
    {
        return new static($id->toString(), $owner, $name, $breed, $age);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBreed(): string
    {
        return $this->breed;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
