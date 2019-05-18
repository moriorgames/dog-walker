<?php

namespace DogWalker\UI\Symfony\Controller;

use DogWalker\Application\Service\GetDogDetails;
use DogWalker\Application\Service\GetDogDetailsInput;
use DogWalker\Application\Service\RegisterDog;
use DogWalker\Application\Service\RegisterDogInput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DogController
{
    public function registerDog(Request $request, RegisterDog $service): JsonResponse
    {
        // @TODO: this is temporary while doing test, remove please
        header("Access-Control-Allow-Origin: *");

        $input = new RegisterDogInput(
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

        $input = new GetDogDetailsInput(
            $request->get('dog_uuid')
        );

        return new JsonResponse(['data' => $service->execute($input)], Response::HTTP_OK);
    }
}
