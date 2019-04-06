<?php

namespace DogWalker\UI\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function ping()
    {
        $response = [
            'data' => [
            ],
        ];

        return new JsonResponse($response, Response::HTTP_OK);
    }
}
