<?php

namespace SitemapPlugin\Model;

use DateTimeInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapUrlInterface
{
    /**
     * @return string
     */
    public function getLocalization(): ?string;

    /**
     * @param string $localization
     */
    public function setLocalization(?string $localization): void;

    /**
     * {@inheritdoc}
     */
    public function addAlternative($location, $locale): void;

    /**
     * {@inheritdoc}
     */
    public function setAlternatives(array $alternatives): void;

    /**
     * {@inheritdoc}
     */
    public function getAlternatives(): array;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $lastModification
     */
    public function setLastModification(DateTimeInterface $lastModification): void;

    /**
     * @return ChangeFrequency
     */
    public function getChangeFrequency(): string;

    /**
     * @param ChangeFrequency $changeFrequency
     */
    public function setChangeFrequency(?ChangeFrequency $changeFrequency): void;

    /**
     * @return float
     */
    public function getPriority(): ?float;

    /**
     * @param float $priority
     */
    public function setPriority(?float $priority): void;
}
