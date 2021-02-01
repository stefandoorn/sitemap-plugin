<?php

declare(strict_types=1);

namespace SitemapPlugin\Filesystem;

use Gaufrette\FilesystemInterface;

final class Writer
{
    /** @var FilesystemInterface */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function write(string $path, string $contents): void
    {
        var_dump($this->filesystem->write($path, $contents, $overwrite = true));
    }
}
