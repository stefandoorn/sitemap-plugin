# Upgrade 1.1 to 2.0

## TL-DR

* Plugin structure upgraded to PluginSkeleton:^1.6
* Removed the `all.xml` endpoint - use the sitemap index
* Sitemaps are now generated via the command line, see below.
* Dropped support for relative URL's
* Models (& their interfaces) renamed
* Drop suggestion that other formats than XML were supported

## New features

* Generation of sitemaps is done via the CLI, schedule them in a cronjob:
    * Sitemap Index: `bin/console sylius:sitemap:generate`
* Sitemap URLs now support adding images. The default providers do this where possible. It can be disabled using the `images` configuration key.

## Removed features

* Dropped support for relative URL's; Google advises to [use fully qualified URL's](https://support.google.com/webmasters/answer/183668?hl=en). 
* Unintentionally the plugin could suggest that other formats than XML were allowed. This was never properly supported and therefore removed.
* Removed the `all.xml` endpoint, which put all URL's in a single file. It's better to use the index file.

## Config changes

* Config file extensions changed from `yml` to `yaml`

## Class changes

* Several classes have been marked `final`.
* Models (& their interface) were renamed. Basically 'Sitemap' was removed from the names where relevant (i.e. where the model is not a sitemap, but part of a sitemap)

## Interface changes

* Interface `UrlInterface` has new methods:
    * `getImages(): Collection`
    * `setImages(Collection $images): void`
    * `addImage(SitemapImageUrlInterface $image): void`
    * `hasImage(SitemapImageUrlInterface $image): bool`
    * `removeImage(SitemapImageUrlInterface $image): void`
    * `public function hasImages(): bool`
* `UrlInterface::setLocalization` got renamed into `UrlInterface::setLocation`
* In several interface several properties became nullable, as the sitemap spec also doesn't require them  
* Adding alternative URLs has been changed, use the factory & inject it via `addAlternative` into the `Url` model  
* Providers now need to have a ChannelContext supplied.
