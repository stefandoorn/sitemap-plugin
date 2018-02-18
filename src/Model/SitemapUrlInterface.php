<?php declare(strict_types=1);

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
    public function setLocalization(string $localization): void;

    /**
     * @param string $location
     * @param string $locale
     */
    public function addAlternative(string $location, string $locale): void;

    /**
     * @param iterable $alternatives
     */
    public function setAlternatives(iterable $alternatives): void;

    /**
     * @return iterable|array
     */
    public function getAlternatives(): iterable;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $lastModification
     */
    public function setLastModification(DateTimeInterface $lastModification): void;

    /**
     * @return string
     */
    public function getChangeFrequency(): string;

    /**
     * @param ChangeFrequency $changeFrequency
     */
    public function setChangeFrequency(ChangeFrequency $changeFrequency): void;

    /**
     * @return float
     */
    public function getPriority(): ?float;

    /**
     * @param float $priority
     */
    public function setPriority(float $priority): void;
}
