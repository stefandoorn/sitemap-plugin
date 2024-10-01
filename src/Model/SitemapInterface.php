<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

interface SitemapInterface
{
    /**
     * @return UrlInterface[]
     */
    public function getUrls(): iterable;

    /**
     * @param UrlInterface[] $urlSet
     */
    public function setUrls(array $urlSet): void;

    public function addUrl(UrlInterface $url): void;

    public function removeUrl(UrlInterface $url): void;

    public function getLocalization(): ?string;

    public function setLocalization(string $localization): void;

    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(DateTimeInterface $lastModification): void;
}
