# Sylius Sitemap Plugin

[![License](https://img.shields.io/packagist/l/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin)
[![Version](https://img.shields.io/packagist/v/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin)
[![Build status on Linux](https://img.shields.io/travis/stefandoorn/sitemap-plugin/master.svg)](http://travis-ci.org/stefandoorn/sitemap-plugin)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/stefandoorn/sitemap-plugin.svg)](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/)
[![Coverage Status](https://coveralls.io/repos/github/stefandoorn/sitemap-plugin/badge.svg?branch=master)](https://coveralls.io/github/stefandoorn/sitemap-plugin?branch=master)

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

## Usage

The plugin defines three default URI's:

* `sitemap.{_format}`: redirects to `sitemap_index.{_format}`
* `sitemap_index.{_format}`: renders the sitemap index file (with links to the provider xml files)
* `sitemap/all.{_format}`: renders all the URI's from all providers in a single response

Next to this, each provider registeres it's own URI. Take a look in the sitemap index file for the correct URI's.

NB: Currently only the `xml` format is supported.

## Default configuration

Get a full list of configuration: `bin/console config:dump-reference sitemap`

```yaml
sitemap:
    providers:
        products: true
        taxons: true
        static: true
    template:             '@SitemapPlugin/show.xml.twig'
    index_template:       '@SitemapPlugin/index.xml.twig'
    exclude_taxon_root:   true
    absolute_url:         true
    hreflang:             true
    images:               true
    static_routes:
        - { route: sylius_shop_homepage, parameters: [], locales: [] }
        - { route: sylius_shop_contact_request, parameters: [], locales: [] }
```

### Feature switches

* `providers`: Enable/disable certain providers to be included in the sitemap. Defaults are true.
* `exclude_taxon_root`: Often you don't want to include the root of your taxon tree as it has a generic name as 'products'.
* `absolute_url`: Whether to generate absolute URL's (true) or relative (false). Defaults to true.
* `hreflang`: Whether to generate alternative URL versions for each locale. Defaults to true. Background: https://support.google.com/webmasters/answer/189077?hl=en.
* `images`: Whether to add images to URL output in case the provider adds them. Defaults to true. Background: https://support.google.com/webmasters/answer/178636?hl=en.

## Default providers

* Products
* Taxons
* Static content (homepage & contact)

## Add own provider

* Register & tag your provider service with `sylius.sitemap_provider`
* Let your provider implement `UrlProviderInterface`
* Use one of the default providers as an example to implement code
