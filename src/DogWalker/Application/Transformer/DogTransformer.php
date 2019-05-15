<?php

namespace DogWalker\Application\Transformer;

use DogWalker\Domain\Entity\Dog;

interface DogTransformer
{
    public function transform(Dog $dog): array;
}
