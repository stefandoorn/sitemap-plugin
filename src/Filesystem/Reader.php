<?php

declare(strict_types=1);

namespace SitemapPlugin\Filesystem;

use Gaufrette\FilesystemInterface;
use Gaufrette\Stream;

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

    public function getStream(string $path): Stream
    {
        return $this->filesystem->createStream($path);
    }
}
