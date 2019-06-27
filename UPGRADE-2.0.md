# Upgrade 1.1 to 2.0

## TL-DR

* Plugin structure upgraded to PluginSkeleton:^1.3

## New features

* Sitemap URLs now support adding images. The default providers do this where possible. It can be disabled using the `images` configuration key.

## Config changes

* Config file extensions changed from `yml` to `yaml`

## Class changes

* Several classes have been marked `final`.
* Models were renamed. Basically 'Sitemap' was removed from the names where relevant (i.e. where the model is not a sitemap, but part of a sitemap)

## Interface changes

* Interface `UrlInterface` has new methods:
    * `getImages(): Collection`
    * `setImages(Collection $images): void`
    * `addImage(SitemapImageUrlInterface $image): void`
    * `hasImage(SitemapImageUrlInterface $image): bool`
    * `removeImage(SitemapImageUrlInterface $image): void`
    * `public function hasImages(): bool`
