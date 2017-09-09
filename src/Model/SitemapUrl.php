<?php declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapUrl implements SitemapUrlInterface
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
     * @var ChangeFrequency
     */
    private $changeFrequency;

    /**
     * @var float
     */
    private $priority;

    /**
     * @var array
     */
    private $alternatives = [];

    /**
     * {@inheritdoc}
     */
    public function addAlternative($location, $locale): void
    {
        $this->alternatives[$locale] = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function setAlternatives(array $alternatives): void
    {
        $this->alternatives = $alternatives;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlternatives(): array
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
    public function setChangeFrequency(ChangeFrequency $changeFrequency)
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
}
