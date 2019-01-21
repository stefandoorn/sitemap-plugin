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
        $response = new Response($this->sitemapRenderer->render($sitemap));
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
