<?php
 
namespace SitemapPlugin\Model;

use DateTimeInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapIndexUrl implements SitemapIndexUrlInterface
{
    /**
     * @var string
     */
    private $localization;

    /**
     * @var DateTimeInterface
     */
    private $lastModification;

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
    public function setLocalization(?string $localization): void
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
    public function setLastModification(?DateTimeInterface $lastModification)
    {
        $this->lastModification = $lastModification;
    }
}
