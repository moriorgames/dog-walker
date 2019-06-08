<?php

namespace DogWalker\Application\UseCase;

class RegisterDogRequest
{
    /** @var string */
    private $owner;
    /** @var string */
    private $name;
    /** @var string */
    private $breed;
    /** @var int */
    private $age;

    public function __construct(string $owner, string $name, string $breed, int $age)
    {
        $this->owner = $owner;
        $this->name = $name;
        $this->breed = $breed;
        $this->age = $age;
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
