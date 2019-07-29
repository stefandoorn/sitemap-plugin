<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Filesystem\Reader;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractController
{
    /** @var Reader */
    protected $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    protected function createResponse(string $path): Response
    {
        if (!$this->reader->has($path)) {
            throw new NotFoundHttpException(sprintf('File "%s" not found', $path));
        }

        $xml = $this->reader->get($path);

        $response = new Response($xml);
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
