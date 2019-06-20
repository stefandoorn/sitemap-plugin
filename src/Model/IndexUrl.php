<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

final class IndexUrl implements IndexUrlInterface
{
    /** @var string */
    private $location;

    /** @var DateTimeInterface|null */
    private $lastModification;

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
