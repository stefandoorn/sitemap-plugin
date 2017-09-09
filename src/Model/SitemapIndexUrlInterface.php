<?php

namespace SitemapPlugin\Model;

use DateTimeInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexUrlInterface
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
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $lastModification
     */
    public function setLastModification(DateTimeInterface $lastModification);
}
