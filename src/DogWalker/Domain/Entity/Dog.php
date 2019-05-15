<?php

namespace DogWalker\Domain\Entity;

use DateTime;

class Dog
{
    /** @var string */
    private $uuid;
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

    private function __construct(string $uuid, string $owner, string $name, string $breed, int $age)
    {
        $this->uuid = $uuid;
        $this->owner = $owner;
        $this->name = $name;
        $this->breed = $breed;
        $this->age = $age;
        $this->createdAt = new DateTime;
        $this->updatedAt = new DateTime;
    }

    public static function create(string $uuid, string $owner, string $name, string $breed, int $age): self
    {
        return new static($uuid, $owner, $name, $breed, $age);
    }

    public function getUuid(): string
    {
        return $this->uuid;
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
