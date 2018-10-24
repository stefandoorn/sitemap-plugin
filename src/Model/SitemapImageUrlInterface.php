<?php declare(strict_types=1);

namespace SitemapPlugin\Model;

/**
 * @author Stéphane DECOCK <s.decock@behappycom.com>
 */
interface SitemapImageUrlInterface
{
    /**
     * @return string
     */
    public function getLocalization(): string;
    
    /**
     * @param string $localization
     */
    public function setLocalization(string $localization): void;
    
    /**
     * @return string
     */
    public function getTitle(): string;
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void;
    
    /**
     * @return string
     */
    public function getCaption(): string;
    
    /**
     * @param string $caption
     */
    public function setCaption(string $caption): void;
    
    /**
     * @return string
     */
    public function getGeoLocation(): string;
    
    /**
     * @param string $geo_location
     */
    public function setGeoLocation(string $geo_location): void;
    
    /**
     * @return string
     */
    public function getLicense(): string;
    
    /**
     * @param string $license
     */
    public function setLicense(string $license): void;
}