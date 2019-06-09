<?php

namespace DogWalker\UI\Symfony\Controller;

use DogWalker\Application\UseCase\RegisterDog;
use DogWalker\Application\UseCase\RegisterDogRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterDogController
{
    public function handle(Request $request, RegisterDog $service)
    {
        $input = new RegisterDogRequest(
            $request->get('owner'),
            $request->get('name'),
            $request->get('breed'),
            $request->get('age')
        );

        return new JsonResponse(['data' => $service->execute($input)], Response::HTTP_CREATED);
    }
}
