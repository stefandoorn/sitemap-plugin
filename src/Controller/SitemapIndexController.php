<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapIndexController extends AbstractController
{
    /** @var SitemapIndexBuilderInterface */
    protected $sitemapBuilder;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapIndexBuilderInterface $sitemapIndexBuilder
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapBuilder = $sitemapIndexBuilder;
    }

    public function showAction(): Response
    {
        return $this->createResponse($this->sitemapBuilder->build());
    }
}
