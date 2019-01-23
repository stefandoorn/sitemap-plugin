<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SitemapController extends AbstractController
{
    /** @var SitemapBuilderInterface */
    protected $sitemapBuilder;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapBuilderInterface $sitemapBuilder
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapBuilder = $sitemapBuilder;
    }

    public function showAction(Request $request): Response
    {
        $filter = [];
        if ($request->attributes->has('name')) {
            $filter[] = $request->attributes->get('name');
        }

        return $this->createResponse($this->sitemapBuilder->build($filter));
    }
}
