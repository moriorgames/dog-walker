<?php

namespace Integration\WebFront\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ClickMeControllerTest extends WebTestCase
{
    public function test_is_able_to_handle_click_me_controller()
    {
        $client = static::createClient();
        $route = $client->getContainer()->get('router')->generate('click_me');

        $client->request('GET', $route);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}

