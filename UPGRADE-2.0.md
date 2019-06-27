# Upgrade 1.1 to 2.0

## TL-DR

* Plugin structure upgraded to PluginSkeleton:^1.3
* Dropped support for relative URL's

## New features

* Sitemap URLs now support adding images. The default providers do this where possible. It can be disabled using the `images` configuration key.

## Removed features

* Dropped support for relative URL's; Google advises to [use fully qualified URL's](https://support.google.com/webmasters/answer/183668?hl=en). 

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
