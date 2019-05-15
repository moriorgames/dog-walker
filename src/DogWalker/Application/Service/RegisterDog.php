<?php

namespace DogWalker\Application\Service;

use DogWalker\Application\Transformer\DogTransformer;
use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\Repository\DogRepository;
use Ramsey\Uuid\Uuid;

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

    public function execute(RegisterDogInput $input): array
    {
        $uuid = Uuid::uuid4()->toString();
        $dog = Dog::create($uuid, $input->getOwner(), $input->getName(), $input->getBreed(), $input->getAge());
        $this->dogRepository->save($dog);

        return $this->dogTransformer->transform($dog);
    }
}
