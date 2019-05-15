<?php

namespace DogWalker\UI\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function ping(): JsonResponse
    {
        return new JsonResponse([
            'data' => [
                'message' => 'success',
            ],
        ], Response::HTTP_OK);
    }
}
