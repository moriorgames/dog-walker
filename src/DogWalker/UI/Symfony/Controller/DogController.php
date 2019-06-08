<?php

namespace DogWalker\UI\Symfony\Controller;

use DogWalker\Application\UseCase\GetDogDetails;
use DogWalker\Application\UseCase\GetDogDetailsRequest;
use DogWalker\Application\UseCase\RegisterDog;
use DogWalker\Application\UseCase\RegisterDogRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DogController
{
    public function registerDog(Request $request, RegisterDog $service): JsonResponse
    {
        // @TODO: this is temporary while doing test, remove please
        header("Access-Control-Allow-Origin: *");

        $input = new RegisterDogRequest(
            $request->get('owner'),
            $request->get('name'),
            $request->get('breed'),
            $request->get('age')
        );

        return new JsonResponse(['data' => $service->execute($input)], Response::HTTP_CREATED);
    }

    public function getDogDetails(Request $request, GetDogDetails $service): JsonResponse
    {
        // @TODO: this is temporary while doing test, remove please
        header("Access-Control-Allow-Origin: *");

        $input = new GetDogDetailsRequest(
            $request->get('dog_uuid')
        );

        return new JsonResponse(['data' => $service->execute($input)], Response::HTTP_OK);
    }
}
