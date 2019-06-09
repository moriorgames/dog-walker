<?php

namespace DogWalker\Infrastructure\Exception;

class EntityNotFoundException extends \Exception
{
    public function __construct(string $className, string $id)
    {
        parent::__construct(sprintf('Entity Not Found: %s(%s)', $className, $id));
    }
}
