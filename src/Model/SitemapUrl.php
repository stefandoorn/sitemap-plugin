<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

class SitemapUrl implements SitemapUrlInterface
{
    /** @var string */
    private $localization;

    /** @var DateTimeInterface */
    private $lastModification;

    /** @var ChangeFrequency */
    private $changeFrequency;

    /** @var float */
    private $priority;

    /** @var iterable|array */
    private $alternatives = [];

    /** @var SitemapImageUrlInterface[]|array */
    private $images = [];

    /**
     * {@inheritdoc}
     */
    public function addAlternative(string $location, string $locale): void
    {
        $this->alternatives[$locale] = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function setAlternatives(iterable $alternatives): void
    {
        $this->alternatives = $alternatives;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlternatives(): iterable
    {
        return $this->alternatives;
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
    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastModification(): ?DateTimeInterface
    {
        return $this->lastModification;
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
    public function getChangeFrequency(): string
    {
        return (string) $this->changeFrequency;
    }

    /**
     * {@inheritdoc}
     */
    public function setChangeFrequency(ChangeFrequency $changeFrequency): void
    {
        $this->changeFrequency = $changeFrequency;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority(): ?float
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function setPriority(float $priority): void
    {
        if (!is_numeric($priority) || 0 > $priority || 1 < $priority) {
            throw new \InvalidArgumentException(sprintf(
                'The value %s is not supported by the option priority, it must be a numeric between 0.0 and 1.0.', $priority
            ));
        }

        $this->priority = $priority;
    }

    /**
     * @return array|SitemapImageUrlInterface[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array|SitemapImageUrlInterface[] $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    public function addImage(SitemapImageUrlInterface $image): void
    {
        $this->images[] = $image;
    }
}
