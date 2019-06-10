<?php

namespace WebFront\UI\Controller;

use Symfony\Component\HttpFoundation\Response;

class HealthController
{
    public function handle(): Response
    {
        return new Response('health');
    }
}
