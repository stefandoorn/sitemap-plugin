<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use Gaufrette\StreamMode;
use SitemapPlugin\Filesystem\Reader;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Stream;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
            throw new NotFoundHttpException(\sprintf('File "%s" not found', $path));
        }

        $stream = new Stream($path);
        $response = new BinaryFileResponse($stream);
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
