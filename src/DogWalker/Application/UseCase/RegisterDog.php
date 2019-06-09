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

    public function execute(RegisterDogRequest $input): array
    {
        $dog = Dog::create(new DogId, $input->getOwner(), $input->getName(), $input->getBreed(), $input->getAge());
        $this->dogRepository->save($dog);

        return $this->dogTransformer->transform($dog);
    }
}
