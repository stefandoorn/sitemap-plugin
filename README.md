# Sylius Sitemap Bundle [![License](https://img.shields.io/packagist/l/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin) [![Version](https://img.shields.io/packagist/v/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin) [![Build status on Linux](https://img.shields.io/travis/stefandoorn/sitemap-plugin/master.svg)](http://travis-ci.org/stefandoorn/sitemap-plugin) [![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/stefandoorn/sitemap-plugin.svg)](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/) [![Code Coverage](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/?branch=master)

## Big thanks

Goes out to the Sylius team. The core code of this plugin is created by the Sylius team.
Unfortunately it got removed from the Sylius core. Luckily the Sylius team approved the 
extraction to a separate bundle.

## Features

* Creates a sitemap index file to point to sub sitemap files per type of data
* Default providers: taxons, products & static content (homepage & contact)
* Easily add your own providers
* Product provider supports locales (hreflang) & is channel aware
* Taxon provider supports locales (hreflang)

## Installation

1. Run `composer require stefandoorn/sitemap-plugin`.
2. Add to `app/AppKernel.php`:

```
  new SitemapPlugin\SitemapPlugin(),
```

3. Add to `app/config/config.yml`: 

```
  - { resource: "@SitemapPlugin/Resources/config/config.yml" }
```

4. Add to `app/config/routing.yml`: 

```
sylius_sitemap:
     resource: "@SitemapPlugin/Resources/config/routing.yml"
```

## Default configuration

Get a full list of configuration: `bin/console config:dump-reference sitemap`

```yaml
sitemap:
    template:             '@SitemapPlugin/show.xml.twig'
    index_template:       '@SitemapPlugin/index.xml.twig'
    exclude_taxon_root:   true
    absolute_url:         true
    hreflang:             true
    static_routes:
        - { route: sylius_shop_homepage, parameters: [], locales: [] }
        - { route: sylius_shop_contact_request, parameters: [], locales: [] }
```

### Feature switches

* `exclude_taxon_root`: Often you don't want to include the root of your taxon tree as it has a generic name as 'products'.
* `absolute_url`: Whether to generate absolute URL's (true) or relative (false). Defaults to true.
* `hreflang`: Whether to generate alternative URL versions for each locale. Defaults to true. Background: https://support.google.com/webmasters/answer/189077?hl=en.

## Default providers

* Products
* Taxons
* Static content (homepage & contact)

## Add own provider

* Register & tag your provider service with `sylius.sitemap_provider`
* Let your provider implement `UrlProviderInterface`
* Use one of the default providers as an example to implement code
