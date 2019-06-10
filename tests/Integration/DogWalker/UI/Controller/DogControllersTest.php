<?php

namespace Integration\DogWalker\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DogControllersTest extends WebTestCase
{
    /** @var Client */
    protected $client;
    /** @var Router */
    private $router;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = parent::createClient();
        $this->router = $this->client->getContainer()->get('router');
    }

    public function test_is_able_to_register_a_dog()
    {
        $route = $this->router->generate('dog_register');

        $postData = [
            'owner' => '33f2cdaa-fd6d-4528-b899-1425f2095c82',
            'name'  => 'Lua',
            'breed' => 'Greyhound',
            'age'   => 6,
        ];

        $this->client->request(Request::METHOD_POST, $route, $postData);

        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('uuid', $response['data']);
        $this->assertArrayHasKey('owner', $response['data']);

        return $response['data']['uuid'];
    }

    public function test_is_able_to_register_a_dog_posting_json_data()
    {
        $route = $this->router->generate('dog_register');

        $postData = [
            'owner' => '33f2cdaa-fd6d-4528-b899-1425f2095c82',
            'name'  => 'Lua',
            'breed' => 'Greyhound',
            'age'   => 6,
        ];

        $this->client->request(
            Request::METHOD_POST, $route, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($postData)
        );

        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('uuid', $response['data']);
        $this->assertArrayHasKey('owner', $response['data']);

        return $response['data']['uuid'];
    }

    /**
     * @depends test_is_able_to_register_a_dog
     *
     * @param string $dogUuid
     */
    public function test_is_able_to_get_dog_details_previously_created(string $dogUuid)
    {
        $route = $this->router->generate('dog_details', ['dog_uuid' => $dogUuid]);

        $this->client->request(Request::METHOD_GET, $route);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
