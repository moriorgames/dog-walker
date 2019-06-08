<?php

namespace Unit\DogWalker\Application\UseCase;

use DogWalker\Application\UseCase\GetDogDetails;
use DogWalker\Application\UseCase\GetDogDetailsRequest;
use DogWalker\Domain\Repository\DogRepository;
use DogWalker\Infrastructure\Transformer\ApiDogTransformer;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Traits\DogTrait;

class GetDogDetailsTest extends TestCase
{
    use DogTrait;

    public function test_is_able_to_obtain_dog_details_by_request()
    {
        $dog = $this->createValidDog();
        /** @var ObjectProphecy|DogRepository $repository */
        $repository = $this->prophesize(DogRepository::class);
        /** @var MethodProphecy $repositoryExpectation */
        $repositoryExpectation = $repository->findById($dog->getUuid())->willReturn($dog);

        $useCase = new GetDogDetails($repository->reveal(), new ApiDogTransformer);
        $request = new GetDogDetailsRequest(
            $dog->getUuid()
        );

        $useCase->execute($request);

        $repositoryExpectation->shouldBeCalledOnce();
    }
}
