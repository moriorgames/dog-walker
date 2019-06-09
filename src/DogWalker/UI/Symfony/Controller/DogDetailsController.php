<?php

namespace DogWalker\UI\Symfony\Controller;

use DogWalker\Application\UseCase\GetDogDetails;
use DogWalker\Application\UseCase\GetDogDetailsRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DogDetailsController
{
    public function handle(Request $request, GetDogDetails $service): JsonResponse
    {
        $input = new GetDogDetailsRequest(
            $request->get('dog_uuid')
        );

        return new JsonResponse(['data' => $service->execute($input)], Response::HTTP_OK);
    }
}
