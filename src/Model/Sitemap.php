<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;
use SitemapPlugin\Exception\SitemapUrlNotFoundException;

final class Sitemap implements SitemapInterface
{
    /** @var array */
    private $urls = [];

    /** @var string */
    private $localization;

    /** @var DateTimeInterface */
    private $lastModification;

    /**
     * {@inheritdoc}
     */
    public function setUrls(array $urls): void
    {
        $this->urls = $urls;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrls(): iterable
    {
        return $this->urls;
    }

    /**
     * {@inheritdoc}
     */
    public function addUrl(UrlInterface $url): void
    {
        $this->urls[] = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function removeUrl(UrlInterface $url): void
    {
        $key = \array_search($url, $this->urls, true);
        if (false === $key) {
            throw new SitemapUrlNotFoundException($url);
        }

        unset($this->urls[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalization(): ?string
    {
        return $this->localization;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastModification(DateTimeInterface $lastModification): void
    {
        $this->lastModification = $lastModification;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastModification(): ?DateTimeInterface
    {
        return $this->lastModification;
    }
}
