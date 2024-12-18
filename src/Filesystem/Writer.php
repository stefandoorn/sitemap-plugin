<?php

declare(strict_types=1);

namespace SitemapPlugin\Filesystem;

use League\Flysystem\FilesystemOperator;

final class Writer
{
    public function __construct(private readonly FilesystemOperator $filesystem)
    {
    }

    public function write(string $path, string $contents): void
    {
        $this->filesystem->write($path, $contents);
    }
}
