<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

interface SitemapUrlInterface
{
    /**
     * @return string
     */
    public function getLocalization(): ?string;

    public function setLocalization(string $localization): void;

    public function addAlternative(string $location, string $locale): void;

    public function setAlternatives(iterable $alternatives): void;

    /**
     * @return iterable|array
     */
    public function getAlternatives(): iterable;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(DateTimeInterface $lastModification): void;

    public function getChangeFrequency(): string;

    public function setChangeFrequency(ChangeFrequency $changeFrequency): void;

    /**
     * @return float
     */
    public function getPriority(): ?float;

    public function setPriority(float $priority): void;

    /**
     * @return array|SitemapImageUrlInterface[]
     */
    public function getImages();

    /**
     * @param array|SitemapImageUrlInterface[] $images
     */
    public function setImages($images): void;

    public function addImage(SitemapImageUrlInterface $image): void;
}
