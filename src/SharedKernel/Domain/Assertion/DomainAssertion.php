<?php

namespace SharedKernel\Domain\Assertion;

use SharedKernel\Domain\Exception\InvalidArgumentException;
use Webmozart\Assert\Assert;

final class DomainAssertion
{
    public static function uuid($value): void
    {
        try {
            Assert::uuid($value);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
