<?php

namespace WebFront\UI\Symfony\Controller;

use Symfony\Component\HttpFoundation\Response;

class HealthController
{
    public function handle(): Response
    {
        return new Response('health');
    }
}
