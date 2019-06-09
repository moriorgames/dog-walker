<?php

namespace DogWalker\UI\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DogController
{
    public function getDogDetails(Request $request): JsonResponse
    {
        // @TODO: this is temporary while doing test, remove please
        header("Access-Control-Allow-Origin: *");

        return new JsonResponse(['data' => []], Response::HTTP_OK);
    }
}
