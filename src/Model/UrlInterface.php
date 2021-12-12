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

    public function getChangeFrequency(): ?string;

    public function setChangeFrequency(ChangeFrequency $changeFrequency): void;

    public function getPriority(): ?float;

    public function setPriority(float $priority): void;

    public function getAlternatives(): Collection;

    public function setAlternatives(iterable $alternatives): void;

    public function addAlternative(AlternativeUrlInterface $alternative): void;

    public function hasAlternative(AlternativeUrlInterface $alternative): bool;

    public function removeAlternative(AlternativeUrlInterface $alternative): void;

    public function hasAlternatives(): bool;

    public function getImages(): Collection;

    public function setImages(iterable $images): void;

    public function addImage(ImageInterface $image): void;

    public function hasImage(ImageInterface $image): bool;

    public function removeImage(ImageInterface $image): void;

    public function hasImages(): bool;
}
