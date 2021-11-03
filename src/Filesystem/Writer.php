<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Filesystem;

use Gaufrette\FilesystemInterface;

final class Writer
{
    private FilesystemInterface $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function write(string $path, string $contents): void
    {
        $this->filesystem->write($path, $contents, $overwrite = true);
    }
}
