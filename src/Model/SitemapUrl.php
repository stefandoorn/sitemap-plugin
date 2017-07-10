<?php

namespace SitemapPlugin\Model;

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
     * @var \DateTime
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
    public function addAlternative($location, $locale)
    {
        $this->alternatives[$locale] = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function setAlternatives(array $alternatives)
    {
        $this->alternatives = $alternatives;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlternatives()
    {
        return $this->alternatives;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastModification()
    {
        return $this->lastModification;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastModification(\DateTime $lastModification)
    {
        $this->lastModification = $lastModification;
    }

    /**
     * {@inheritdoc}
     */
    public function getChangeFrequency()
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
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function setPriority($priority)
    {
        if (!is_numeric($priority) || 0 > $priority || 1 < $priority) {
            throw new \InvalidArgumentException(sprintf(
                'The value %s is not supported by the option priority, it must be a numeric between 0.0 and 1.0.', $priority
            ));
        }

        $this->priority = $priority;
    }
}
