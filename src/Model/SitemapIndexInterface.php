<?php declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexInterface
{
    /**
     * @return SitemapUrlInterface[]
     */
    public function getUrls(): iterable;

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
     * {@inheritdoc}
     */
    public function setLocalization(string $localization): void;

    /**
     * {@inheritdoc}
     */
    public function getLocalization(): ?string;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $lastModification
     */
    public function setLastModification(DateTimeInterface $lastModification);
}
