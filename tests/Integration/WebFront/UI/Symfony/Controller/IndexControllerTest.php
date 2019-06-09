<?php

namespace Integration\WebFront\UI\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class IndexControllerTest extends WebTestCase
{
    public function test_is_able_to_handle_index_controller()
    {
        $client = static::createClient();
        $route = $client->getContainer()->get('router')->generate('index');

        $client->request('GET', $route);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
