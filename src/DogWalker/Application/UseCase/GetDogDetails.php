<?php

namespace DogWalker\Application\UseCase;

use DogWalker\Application\Transformer\DogTransformer;
use DogWalker\Domain\Repository\DogRepository;

class GetDogDetails
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

    public function execute(GetDogDetailsRequest $request): array
    {
        $dog = $this->dogRepository->findById($request->getUuid());

        return $this->dogTransformer->transform($dog);
    }
}
