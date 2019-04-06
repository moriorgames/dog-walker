<?php

namespace DogWalker\Domain\Entity;

class Dog
{
    /** @var string */
    private $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
