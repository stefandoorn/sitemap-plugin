<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    /** @var SitemapRendererInterface */
    protected $sitemapRenderer;

    protected function createResponse(SitemapInterface $sitemap): Response
    {
        @trigger_error('createResponse will be removed in 2.0', E_USER_DEPRECATED);

        return $this->createXmlResponse($this->sitemapRenderer->render($sitemap));
    }

    protected function createXmlResponse(string $xml): Response
    {
        $response = new Response($xml);
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
