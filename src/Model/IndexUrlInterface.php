<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Model;

use DateTimeInterface;

interface IndexUrlInterface
{
    public function getLocation(): string;

    public function setLocation(string $location): void;

    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(?DateTimeInterface $lastModification): void;
}
