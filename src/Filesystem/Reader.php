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

    public function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }

    public function get(string $path): string
    {
        return $this->filesystem->read($path);
    }
}
