<?php

declare(strict_types=1);

namespace SitemapPlugin\Writer;

use \Gaufrette\FilesystemInterface;

final class FilesystemWriter
{
    /** @var FilesystemInterface */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }
    
    public function write(string $path, string $contents): void
    {
        $this->filesystem->write($path, $contents);
    }
}
