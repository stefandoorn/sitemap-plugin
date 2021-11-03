<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Controller;

use Gaufrette\StreamMode;
use StefanDoorn\SyliusSitemapPlugin\Filesystem\Reader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractController
{
    protected Reader $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    protected function createResponse(string $path): Response
    {
        if (!$this->reader->has($path)) {
            throw new NotFoundHttpException(\sprintf('File "%s" not found', $path));
        }

        $response = new StreamedResponse(function () use ($path): void {
            $stream = $this->reader->getStream($path);
            $stream->open(new StreamMode('r'));
            while (!$stream->eof()) {
                echo $stream->read(100000);
            }
            $stream->close();
        });
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
