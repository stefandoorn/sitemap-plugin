<?php

namespace SyliusSitemapBundle\Controller;

use SyliusSitemapBundle\Builder\SitemapBuilderInterface;
use SyliusSitemapBundle\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapController
{
    /**
     * @var SitemapRendererInterface
     */
    private $sitemapRenderer;

    /**
     * @var SitemapBuilderInterface
     */
    private $sitemapBuilder;

    /**
     * @param SitemapRendererInterface $sitemapRenderer
     * @param SitemapBuilderInterface $sitemapBuilder
     */
    public function __construct(SitemapRendererInterface $sitemapRenderer, SitemapBuilderInterface $sitemapBuilder)
    {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapBuilder = $sitemapBuilder;
    }

    /**
     * @return Response
     */
    public function showAction(Request $request)
    {
        $filter = [];
        if ($request->attributes->has('name')) {
            $filter[] = $request->attributes->get('name');
        }

        $sitemap = $this->sitemapBuilder->build($filter);

        $response = new Response($this->sitemapRenderer->render($sitemap));
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
