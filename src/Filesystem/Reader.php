<?php

declare(strict_types=1);

namespace SitemapPlugin\Filesystem;

use Gaufrette\FilesystemInterface;

final class Reader
{
    /** @var FilesystemInterface */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function get(string $path): string
    {
        $this->filesystem->read($path);
    }
}
