<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected function createResponse(string $xml): Response
    {
        $response = new Response($xml);
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
