<?php

namespace Unit\DogWalker\Application\UseCase;

use DogWalker\Application\UseCase\RegisterDog;
use DogWalker\Application\UseCase\RegisterDogRequest;
use DogWalker\Domain\Entity\Dog;
use DogWalker\Domain\Repository\DogRepository;
use DogWalker\Infrastructure\Repository\Traits\DogTrait;
use DogWalker\Infrastructure\Transformer\ApiDogTransformer;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;

class RegisterDogTest extends TestCase
{
    use DogTrait;

    public function test_is_able_to_register_a_new_dog_through_use_case()
    {
        $dog = $this->createValidDog();
        /** @var ObjectProphecy|DogRepository $repository */
        $repository = $this->prophesize(DogRepository::class);
        /** @var MethodProphecy $repositoryExpectation */
        $repositoryExpectation = $repository->save(Argument::type(Dog::class));
        $sut = new RegisterDog($repository->reveal(), new ApiDogTransformer);
        $request = new RegisterDogRequest(
            $dog->getOwner(),
            $dog->getName(),
            $dog->getBreed(),
            $dog->getAge()
        );

        $sut->execute($request);

        $repositoryExpectation->shouldBeCalledOnce();
    }
}
