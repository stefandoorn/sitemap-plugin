<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Model;

use DateTimeInterface;

final class IndexUrl implements IndexUrlInterface
{
    private string $location;

    private ?DateTimeInterface $lastModification = null;

    public function __construct(string $location)
    {
        $this->setLocation($location);
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getLastModification(): ?DateTimeInterface
    {
        return $this->lastModification;
    }

    public function setLastModification(?DateTimeInterface $lastModification): void
    {
        $this->lastModification = $lastModification;
    }
}
