# Upgrade 1.1 to 2.0

## TL-DR

* Plugin structure upgraded to PluginSkeleton:^1.3

## New features

* Sitemap URLs now support adding images. The default providers do this where possible. It can be disabled using the `images` configuration key.

## Class changes

* Several classes have been marked `final`.

## Interface changes

* Interface `SitemapUrlInterface` has new methods:
    * `getImages(): Collection`
    * `setImages(Collection $images): void`
    * `addImage(SitemapImageUrlInterface $image): void`
    * `hasImage(SitemapImageUrlInterface $image): bool`
    * `removeImage(SitemapImageUrlInterface $image): void`
    * `public function hasImages(): bool`
