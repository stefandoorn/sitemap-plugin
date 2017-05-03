<?php

namespace SitemapPlugin\Controller;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
abstract class AbstractController
{
    /**
     * @var SitemapRendererInterface
     */
    protected $sitemapRenderer;

    /**
     * @param SitemapInterface $sitemap
     * @return Response
     */
    protected function createResponse(SitemapInterface $sitemap): Response
    {
        $response = new Response($this->sitemapRenderer->render($sitemap));
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
