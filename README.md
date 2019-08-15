# Sylius Sitemap Plugin

[![License](https://img.shields.io/packagist/l/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin)
[![Version](https://img.shields.io/packagist/v/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin)
[![Build status on Linux](https://img.shields.io/travis/stefandoorn/sitemap-plugin/master.svg)](http://travis-ci.org/stefandoorn/sitemap-plugin)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/stefandoorn/sitemap-plugin.svg)](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/)
[![Coverage Status](https://coveralls.io/repos/github/stefandoorn/sitemap-plugin/badge.svg?branch=master)](https://coveralls.io/github/stefandoorn/sitemap-plugin?branch=master)

<p align="center"><a href="https://sylius.com/plugins/" target="_blank"><img src="https://sylius.com/assets/badge-approved-by-sylius.png" width="200"></a></p>

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

2. Then, enable the plugin by adding it to the list of registered plugins/bundles in the `config/bundles.php` file of your project:
   
   ```php
   <?php
   
   return [
       // ...
    
       Setono\DoctrineORMBatcherBundle\SetonoDoctrineORMBatcherBundle::class => ['all' => true],
       SitemapPlugin\SitemapPlugin::class => ['all' => true],
           
       // ...
   ];
   ```

3. Add to `config/packages/stefandoorn_sylius_sitemap.yaml`: 

    ```
    imports:
        - { resource: "@SitemapPlugin/Resources/config/config.yaml" }
    ```

4. Add to `config/routes.yaml`: 

    ```
    stefandoorn_sylius_sitemap:
        resource: "@SitemapPlugin/Resources/config/routing.yml"
    ```

## Usage

The plugin defines three default URI's:

* `sitemap.xml`: redirects to `sitemap_index.xml`
* `sitemap_index.xml`: renders the sitemap index file (with links to the provider xml files)
* `sitemap/all.xml`: renders all the URI's from all providers in a single response

Next to this, each provider registeres it's own URI. Take a look in the sitemap index file for the correct URI's.

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
    hreflang:             true
    images:               true
    static_routes:
        - { route: sylius_shop_homepage, parameters: [], locales: [] }
        - { route: sylius_shop_contact_request, parameters: [], locales: [] }
```

## Default storage

By default the sitemaps will be saved in `%kernel.root_dir%/var/sitemap`. You can change this setting 
by adjusting the parameter `sylius.sitemap.path`.

### Feature switches

* `providers`: Enable/disable certain providers to be included in the sitemap. Defaults are true.
* `exclude_taxon_root`: Often you don't want to include the root of your taxon tree as it has a generic name as 'products'.
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
