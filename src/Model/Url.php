<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Url implements UrlInterface
{
    /** @var string */
    private $location;

    /** @var DateTimeInterface */
    private $lastModification;

    /** @var string */
    private $changeFrequency;

    /** @var float */
    private $priority;

    /** @var Collection */
    private $alternatives;

    /** @var Collection|ImageInterface[] */
    private $images;

    public function __construct(string $location)
    {
        $this->setLocation($location);
        $this->alternatives = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function setLastModification(DateTimeInterface $lastModification): void
    {
        $this->lastModification = $lastModification;
    }

    public function getChangeFrequency(): string
    {
        return $this->changeFrequency;
    }

    public function setChangeFrequency(ChangeFrequency $changeFrequency): void
    {
        $this->changeFrequency = (string) $changeFrequency;
    }

    public function getPriority(): ?float
    {
        return $this->priority;
    }

    public function setPriority(float $priority): void
    {
        if (0 > $priority || 1 < $priority) {
            throw new \InvalidArgumentException(\sprintf(
                'The value %s is not supported by the option priority, it must be a number between 0.0 and 1.0.', $priority
            ));
        }

        $this->priority = $priority;
    }

    /**
     * @return Collection|AlternativeUrlInterface[]
     */
    public function getAlternatives(): Collection
    {
        return $this->alternatives;
    }

    /**
     * @param AlternativeUrlInterface[] $alternatives
     */
    public function setAlternatives(iterable $alternatives): void
    {
        $this->alternatives->clear();

        foreach ($alternatives as $alternative) {
            $this->addAlternative($alternative);
        }
    }

    public function addAlternative(AlternativeUrlInterface $alternative): void
    {
        $this->alternatives->add($alternative);
    }

    public function hasAlternative(AlternativeUrlInterface $alternative): bool
    {
        return $this->alternatives->contains($alternative);
    }

    public function removeAlternative(AlternativeUrlInterface $alternative): void
    {
        if ($this->hasAlternative($alternative)) {
            $this->alternatives->removeElement($alternative);
        }
    }

    public function hasAlternatives(): bool
    {
        return !$this->alternatives->isEmpty();
    }

    /**
     * @return Collection|ImageInterface[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param ImageInterface[] $images
     */
    public function setImages(iterable $images): void
    {
        $this->images->clear();

        foreach ($images as $image) {
            $this->addImage($image);
        }
    }

    public function addImage(ImageInterface $image): void
    {
        $this->images->add($image);
    }

    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $this->images->removeElement($image);
        }
    }

    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }
}
