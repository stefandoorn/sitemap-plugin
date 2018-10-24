<?php declare(strict_types=1);

namespace SitemapPlugin\Model;

/**
 * @author Stéphane DECOCK <s.decock@behappycom.com>
 */
class SitemapImageUrl implements SitemapImageUrlInterface
{
    /**
     * @var string
     */
    private $localization;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var string
     */
    private $caption;
    
    /**
     * @var string
     */
    private $geo_location;
    
    /**
     * @var string
     */
    private $license;
    
    /**
     * @return string
     */
    public function getLocalization(): string
    {
        return $this->localization;
    }
    
    /**
     * @param string $localization
     */
    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }
    
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }
    
    /**
     * @param string $caption
     */
    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }
    
    /**
     * @return string
     */
    public function getGeoLocation(): string
    {
        return $this->geo_location;
    }
    
    /**
     * @param string $geo_location
     */
    public function setGeoLocation(string $geo_location): void
    {
        $this->geo_location = $geo_location;
    }
    
    /**
     * @return string
     */
    public function getLicense(): string
    {
        return $this->license;
    }
    
    /**
     * @param string $license
     */
    public function setLicense(string $license): void
    {
        $this->license = $license;
    }
}