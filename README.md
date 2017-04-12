# Sylius Sitemap Bundle [![License](https://img.shields.io/packagist/l/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin) [![Version](https://img.shields.io/packagist/v/stefandoorn/sitemap-plugin.svg)](https://packagist.org/packages/stefandoorn/sitemap-plugin) [![Build status on Linux](https://img.shields.io/travis/stefandoorn/sitemap-plugin/master.svg)](http://travis-ci.org/stefandoorn/sitemap-plugin) [![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/stefandoorn/sitemap-plugin.svg)](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/) [![Code Coverage](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/stefandoorn/sitemap-plugin/?branch=master)

## Big thanks

Goes out to the Sylius team. The core code of this plugin is created by the Sylius team.
Unfortunately it got removed from the Sylius core. Luckily the Sylius team approved the 
extraction to a separate bundle.

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
