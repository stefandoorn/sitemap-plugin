<?php

namespace SitemapPlugin\Controller;

use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapController extends AbstractController
{
    /**
     * @var SitemapBuilderInterface
     */
    protected $sitemapBuilder;

    /**
     * @param SitemapRendererInterface $sitemapRenderer
     * @param SitemapBuilderInterface $sitemapBuilder
     */
    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapBuilderInterface $sitemapIndexBuilder
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapIndexBuilder = $sitemapIndexBuilder;
    }

    /**
     * @return Response
     */
    public function showAction(Request $request): Response
    {
        $filter = [];
        if ($request->attributes->has('name')) {
            $filter[] = $request->attributes->get('name');
        }

        return $this->createResponse($this->sitemapBuilder->build($filter));
    }
}
