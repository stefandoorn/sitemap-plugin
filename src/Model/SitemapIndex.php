<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Model;

use DateTimeInterface;
use StefanDoorn\SyliusSitemapPlugin\Exception\SitemapUrlNotFoundException;

final class SitemapIndex implements SitemapInterface
{
    private array $urls = [];

    private string $localization;

    private DateTimeInterface $lastModification;

    public function setUrls(array $urls): void
    {
        $this->urls = $urls;
    }

    public function getUrls(): iterable
    {
        return $this->urls;
    }

    public function addUrl(UrlInterface $url): void
    {
        $this->urls[] = $url;
    }

    public function removeUrl(UrlInterface $url): void
    {
        $key = \array_search($url, $this->urls, true);
        if (false === $key) {
            throw new SitemapUrlNotFoundException($url);
        }

        unset($this->urls[$key]);
    }

    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }

    public function getLocalization(): string
    {
        return $this->localization;
    }

    public function setLastModification(DateTimeInterface $lastModification): void
    {
        $this->lastModification = $lastModification;
    }

    public function getLastModification(): ?DateTimeInterface
    {
        return $this->lastModification;
    }
}
