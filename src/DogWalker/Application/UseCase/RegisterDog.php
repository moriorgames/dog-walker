<?php

namespace DogWalker\Application\UseCase;

use DogWalker\Application\Transformer\DogTransformer;
use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\Repository\DogRepository;
use DogWalker\Domain\ValueObject\DogId;

class RegisterDog
{
    /** @var DogRepository */
    private $dogRepository;
    /** @var DogTransformer */
    private $dogTransformer;

    public function __construct(DogRepository $dogRepository, DogTransformer $dogTransformer)
    {
        $this->dogRepository = $dogRepository;
        $this->dogTransformer = $dogTransformer;
    }

    public function execute(RegisterDogRequest $request): array
    {
        $dog = Dog::create(new DogId, $request->getOwner(), $request->getName(), $request->getBreed(), $request->getAge());
        $this->dogRepository->save($dog);

        return $this->dogTransformer->transform($dog);
    }
}
