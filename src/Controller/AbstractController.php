<?php

namespace SitemapPlugin\Controller;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @var SitemapIndexBuilderInterface
     */
    protected $sitemapIndexBuilder;

    /**
     * @param SitemapRendererInterface $sitemapRenderer
     * @param SitemapIndexBuilderInterface $sitemapBuilder
     */
    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapIndexBuilderInterface $sitemapIndexBuilder
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapIndexBuilder = $sitemapIndexBuilder;
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

        $sitemap = $this->sitemapIndexBuilder->build();

        $response = new Response($this->sitemapRenderer->render($sitemap));
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
