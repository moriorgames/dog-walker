<?php

namespace SharedKernel\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class Id
{
    /** @var string */
    private $uuid;

    public function __construct(string $uuid = null)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
    }

    public function toString(): string
    {
        return $this->uuid;
    }
}
