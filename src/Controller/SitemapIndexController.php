<?php

namespace SitemapPlugin\Controller;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapIndexController extends AbstractController
{
    /**
     * @var SitemapIndexBuilderInterface
     */
    protected $sitemapBuilder;

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
    public function showAction(Request $request): Response
    {
        return $this->createResponse($this->sitemapBuilder->build($filter));
    }
}
