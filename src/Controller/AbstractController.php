<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToReadFile;
use SitemapPlugin\Filesystem\Reader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractController
{
    public function __construct(private readonly Reader $reader)
    {
    }

    protected function createResponse(string $path): Response
    {
        $response = new StreamedResponse(function () use ($path): void {
            try {
                $handle = $this->reader->getStream($path);

                while (!\feof($handle)) {
                    echo \fread($handle, 8192);
                }
            } catch (UnableToReadFile | FilesystemException) {
                throw new NotFoundHttpException(\sprintf('File "%s" not found', $path));
            }
        });
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
