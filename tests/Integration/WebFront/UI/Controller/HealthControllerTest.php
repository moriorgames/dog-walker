<?php

namespace Integration\WebFront\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HealthControllerTest extends WebTestCase
{
    public function test_is_able_to_handle_health_controller()
    {
        $client = static::createClient();
        $route = $client->getContainer()->get('router')->generate('health');

        $client->request('GET', $route);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
