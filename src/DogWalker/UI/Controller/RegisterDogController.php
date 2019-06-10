<?php

namespace DogWalker\UI\Controller;

use DogWalker\Application\UseCase\RegisterDog;
use Nelmio\ApiDocBundle\Annotation\Model;
use DogWalker\Application\UseCase\RegisterDogRequest;
use SharedKernel\UI\Controller\RequestValidable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;

class RegisterDogController implements RequestValidable
{
    /**
     * Register a dog
     *
     * @SWG\Post(
     *    consumes={"application/json"},
     *    produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         type="object",
     *         @Model(type=DogWalker\Application\UseCase\RegisterDogRequest::class)
     *     )
     * )
     * @SWG\Response(response=201, description="Created")
     *
     * @param Request     $request
     * @param RegisterDog $service
     *
     * @return JsonResponse
     */
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
