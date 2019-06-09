<?php

namespace DogWalker\Infrastructure\Transformer;

use DogWalker\Application\Transformer\DogTransformer;
use DogWalker\Domain\Entity\Dog;

class ApiDogTransformer implements DogTransformer
{
    public function transform(Dog $dog): array
    {
        return [
            'uuid'  => $dog->getId(),
            'owner' => $dog->getOwner(),
            'name'  => $dog->getName(),
            'breed' => $dog->getBreed(),
            'age'   => $dog->getAge(),
        ];
    }
}
