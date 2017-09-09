<?php declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param SitemapIndexBuilderInterface $sitemapIndexBuilder
     */
    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapIndexBuilderInterface $sitemapIndexBuilder
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapBuilder = $sitemapIndexBuilder;
    }

    /**
     * @return Response
     */
    public function showAction(): Response
    {
        return $this->createResponse($this->sitemapBuilder->build());
    }
}
