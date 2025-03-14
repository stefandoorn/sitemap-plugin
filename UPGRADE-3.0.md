# Upgrade 2.x to 3.0

## Upgrade

Upgrading might be as simple as running the following command:

```bash
$ composer require stefandoorn/sitemap-plugin:^3.0
```

Keep reading to understand the main changes that happened as part of the 3.0 release.

## Main changes

### Sylius

The plugin has been upgraded to work with Sylius ^2.0.

Also, the testing structure has been updated as much possible to reflect `PluginSkeleton^2.0`.

### PHP

Sylius 2.0 requires a minimum of PHP 8.2, and the plugin has been updated similarly.

### Filesystem

Since Nov, 2022 Sylius uses Flysystem as it's default filesystem implementation.

From Sylius 2.0, this driver has become the default.

The plugin has been updated to use Flysystem.

If you did make configuration changes, have a look at `src/Resources/config/config.yaml` for the new configuration.

#### Breaking change

`Filesystem/Reader::has` has been removed, as we can rely on Flysystem exceptions now.

As a side benefit, this also saves an I/O operation.

`AbstractController::$reader` has been made `private`.

### Data providers (potential breaking change)

Both the `product` & `taxon` URL provider have been changed. The data fetching part of them has been extracted
into separate services.

This change should make it easier for you to adjust only the data fetching, and not adjust the actual URL provider as well.

In case you have adjusted these providers, this might incur a breaking change for you. Please do review your implementation.

