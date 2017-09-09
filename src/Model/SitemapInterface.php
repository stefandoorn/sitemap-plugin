<?php

namespace SitemapPlugin\Model;

use DateTimeInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapInterface
{
    /**
     * @return SitemapUrlInterface[]
     */
    public function getUrls(): array;

    /**
     * @param SitemapUrlInterface[] $urlSet
     */
    public function setUrls(array $urlSet): void;

    /**
     * @param SitemapUrlInterface $url
     */
    public function addUrl(SitemapUrlInterface $url): void;

    /**
     * @param SitemapUrlInterface $url
     */
    public function removeUrl(SitemapUrlInterface $url): void;

    /**
     * @return string
     */
    public function getLocalization(): ?string;

    /**
     * @param string $localization
     */
    public function setLocalization(string $localization): void;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $lastModification
     */
    public function setLastModification(DateTimeInterface $lastModification);
}
