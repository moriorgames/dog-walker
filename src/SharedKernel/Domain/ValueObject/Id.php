<?php

namespace SharedKernel\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use SharedKernel\Domain\Assertion\DomainAssertion;

class Id
{
    /** @var string */
    private $uuid;

    public function __construct(string $uuid = null)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
        DomainAssertion::uuid($this->uuid);
    }

    public function toString(): string
    {
        return $this->uuid;
    }
}
