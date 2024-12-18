<?php

declare(strict_types=1);

namespace SitemapPlugin\Filesystem;

use League\Flysystem\FilesystemOperator;

final class Reader
{
    public function __construct(private readonly FilesystemOperator $filesystem)
    {
    }

    /**
     * @return resource
     */
    public function getStream(string $path): mixed
    {
        return $this->filesystem->readStream($path);
    }
}
