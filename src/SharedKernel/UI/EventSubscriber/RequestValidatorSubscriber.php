<?php

namespace SharedKernel\UI\EventSubscriber;

use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;
use SharedKernel\UI\Controller\RequestValidable;
use SharedKernel\UI\Exception\RequestValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidatorSubscriber implements EventSubscriberInterface
{
    public const CONTROLLER_METHOD = 'handle';

    private const USE_CASE_PARAM_SUFFIX = 'Request';

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (!$this->isValidControllerToBeValidated($controller)) {
            return false;
        }

        $controllerName = get_class($controller[0]);
        $reflectionMethod = new ReflectionMethod($controllerName, self::CONTROLLER_METHOD);
        /** @var ReflectionParameter $param */
        foreach ($reflectionMethod->getParameters() as $param) {
            if ($param->getPosition() === 1) {
                $paramClass = $param->getType()->getName() . self::USE_CASE_PARAM_SUFFIX;
                if (!class_exists($paramClass)) {
                    return false;
                }
                $this->validateParamFromRequest($event->getRequest(), $paramClass);

                return true;
            }
        }

        return false;
    }

    private function isValidControllerToBeValidated($controller): bool
    {
        if (!is_array($controller)) {
            return false;
        }
        if (!$controller[0] instanceof RequestValidable) {
            return false;
        }
        if (!method_exists($controller[0], self::CONTROLLER_METHOD)) {
            return false;
        }

        return true;
    }

    private function validateParamFromRequest(Request $request, string $paramClass): void
    {
        $reflectionClass = new ReflectionClass($paramClass);
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
