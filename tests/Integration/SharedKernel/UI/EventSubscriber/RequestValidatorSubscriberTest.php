<?php

namespace Integration\SharedKernel\UI\EventSubscriber;

use DogWalker\UI\Controller\RegisterDogController;
use SharedKernel\UI\Controller\RequestValidable;
use SharedKernel\UI\EventSubscriber\RequestValidatorSubscriber;
use SharedKernel\UI\Exception\RequestValidationException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use WebFront\UI\Controller\IndexController;

class RequestValidatorSubscriberTest extends WebTestCase
{
    /** @var RequestValidatorSubscriber */
    private $sut = null;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = self::$container->get('event_dispatcher');
        $events = $dispatcher->getListeners(KernelEvents::CONTROLLER);
        foreach ($events as $event) {
            if (get_class($event[0]) === RequestValidatorSubscriber::class) {
                $this->sut = $event[0];
            }
        }
        if ($this->sut === null) {
            throw new \LogicException('Service not found');
        }
    }

    public function test_does_not_validate_closure_controller()
    {
        $notCallableController = function () {
            return;
        };
        $controllerEvent = new ControllerEvent(self::$kernel, $notCallableController, new Request, null);
        $result = $this->sut->validate($controllerEvent);

        $this->assertFalse($result);
    }

    public function test_does_not_validate_a_controller_not_implementing_RequestValidable_interface()
    {
        $callableController = [new IndexController, RequestValidatorSubscriber::CONTROLLER_METHOD];
        $controllerEvent = new ControllerEvent(self::$kernel, $callableController, new Request, null);
        $result = $this->sut->validate($controllerEvent);

        $this->assertFalse($result);
    }

    public function test_does_not_validate_a_controller_without_handle_method()
    {
        $callableController = [new ControllerWithoutHandle, 'noHandle'];
        $controllerEvent = new ControllerEvent(self::$kernel, $callableController, new Request, null);
        $result = $this->sut->validate($controllerEvent);

        $this->assertFalse($result);
    }

    public function test_does_not_validate_a_controller_with_handle_method_but_no_params()
    {
        $callableController = [new ControllerWithoutParams, RequestValidatorSubscriber::CONTROLLER_METHOD];
        $controllerEvent = new ControllerEvent(self::$kernel, $callableController, new Request, null);
        $result = $this->sut->validate($controllerEvent);

        $this->assertFalse($result);
    }

    public function test_does_not_validate_a_controller_with_no_UseCase_Request_related()
    {
        $callableController = [new ControllerWithoutUseCaseRequest, RequestValidatorSubscriber::CONTROLLER_METHOD];
        $controllerEvent = new ControllerEvent(self::$kernel, $callableController, new Request, null);
        $result = $this->sut->validate($controllerEvent);

        $this->assertFalse($result);
    }

    public function test_throws_an_Exception_when_params_are_not_valid()
    {
        $this->expectException(RequestValidationException::class);

        $callableController = [new RegisterDogController, RequestValidatorSubscriber::CONTROLLER_METHOD];
        $controllerEvent = new ControllerEvent(self::$kernel, $callableController, new Request, null);
        $this->sut->validate($controllerEvent);
    }

    public function test_is_able_to_validate_incoming_params_to_a_controller()
    {
        $request = new Request([
            'owner' => '33f2cdaa-fd6d-4528-b899-1425f2095c82',
            'name'  => 'Lua',
            'breed' => 'Greyhound',
            'age'   => 6,
        ]);
        $callableController = [new RegisterDogController, RequestValidatorSubscriber::CONTROLLER_METHOD];
        $controllerEvent = new ControllerEvent(self::$kernel, $callableController, $request, null);
        $result = $this->sut->validate($controllerEvent);

        $this->assertTrue($result);
    }
}

class ControllerWithoutHandle implements RequestValidable
{
    public function noHandle(string $request, string $service): Response
    {
        return new Response('health');
    }
}

class ControllerWithoutUseCaseRequest implements RequestValidable
{
    public function handle(string $request, string $service): Response
    {
        return new Response('health');
    }
}

class ControllerWithoutParams implements RequestValidable
{
    public function handle(): Response
    {
        return new Response('health');
    }
}
