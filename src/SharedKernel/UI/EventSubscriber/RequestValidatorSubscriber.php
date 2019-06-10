<?php

namespace SharedKernel\UI\EventSubscriber;

use ReflectionClass;
use SharedKernel\UI\Controller\RequestValidable;
use SharedKernel\UI\Exception\RequestValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidatorSubscriber implements EventSubscriberInterface
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof RequestValidable) {
            $command = str_replace(
                ['UI\Controller', 'Controller'],
                ['Application\UseCase', 'Request'],
                get_class($controller[0])
            );
            $this->validateCommandFromRequest($event->getRequest(), $command);
        }
    }

    private function validateCommandFromRequest(Request $request, string $commandClass): void
    {
        $reflectionClass = new ReflectionClass($commandClass);
        $rc = $reflectionClass->newInstanceWithoutConstructor();

        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $requestKey = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $property->getName()));
            $property->setAccessible(true);
            $property->setValue($rc, $request->get($requestKey));
        }

        $errors = $this->validator->validate($rc);
        if (count($errors) > 0) {
            throw new RequestValidationException($this->getErrorMessages($errors));
        }
    }

    private function getErrorMessages(ConstraintViolationListInterface $errors): array
    {
        $errorList = [];
        foreach ($errors as $error) {
            $errorList[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errorList;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'validate',
        ];
    }
}
