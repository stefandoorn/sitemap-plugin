<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

interface SitemapUrlInterface
{
    public function getLocalization(): ?string;

    public function setLocalization(string $localization): void;

    public function addAlternative(string $location, string $locale): void;

    public function setAlternatives(iterable $alternatives): void;

    public function getAlternatives(): iterable;

    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(DateTimeInterface $lastModification): void;

    public function getChangeFrequency(): string;

    public function setChangeFrequency(ChangeFrequency $changeFrequency): void;

    public function getPriority(): ?float;

    public function setPriority(float $priority): void;

    /**
     * @return Collection|SitemapImageUrlInterface[]
     */
    public function getImages(): Collection;

    /**
     * @param Collection|SitemapImageUrlInterface[] $images
     */
    public function setImages(Collection $images): void;

    public function addImage(SitemapImageUrlInterface $image): void;
}
