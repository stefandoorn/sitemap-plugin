<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

interface UrlInterface
{
    public function getLocation(): string;

    public function setLocation(string $location): void;

    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(DateTimeInterface $lastModification): void;

    public function getChangeFrequency(): string;

    public function setChangeFrequency(ChangeFrequency $changeFrequency): void;

    public function getPriority(): ?float;

    public function setPriority(float $priority): void;

    /**
     * @return Collection|UrlAlternativeInterface[]
     */
    public function getAlternatives(): Collection;

    /**
     * @param UrlAlternativeInterface[] $alternatives
     */
    public function setAlternatives(iterable $alternatives): void;

    public function addAlternative(UrlAlternativeInterface $image): void;

    public function hasAlternative(UrlAlternativeInterface $image): bool;

    public function removeAlternative(UrlAlternativeInterface $image): void;

    public function hasAlternatives(): bool;

    /**
     * @return Collection|ImageInterface[]
     */
    public function getImages(): Collection;

    /**
     * @param ImageInterface[] $images
     */
    public function setImages(iterable $images): void;

    public function addImage(ImageInterface $image): void;

    public function hasImage(ImageInterface $image): bool;

    public function removeImage(ImageInterface $image): void;

    public function hasImages(): bool;
}
