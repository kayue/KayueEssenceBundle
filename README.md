KayueEssenceBundle
==================

This bundle integrates the [Essence](https://github.com/felixgirault/essence) library (an oEmbed library) into Symfony 2.


## Installation

#### Composer

Add the bundle to `composer.json`

```json
{
    "require": {
        "kayue/kayue-essence-bundle": "dev-master"
    }
}
```

Update Composer dependency:

```
composer update kayue/kayue-essence-bundle
```

#### Register the bundle

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Kayue\EssenceBundle\KayueEssenceBundle(),
    );
    // ...
}
```

## Configuration

No configuration is required. However you should change the cache driver to `apc` if your browser support it. Default cache driver is `array`

```yaml
kayue_essence:
    cache_driver: apc
```

## Usage

### Service

```php
<?php

class WelcomeController extends Controller
{
    public function indexAction()
    {
        $essence = $this->get('kayue_essence');
        $media = $essence->embed('http://www.youtube.com/watch?v=39e3KYAmXK4');
        $media->title; // return the video title "Bill Hicks - Revelations (1993)"
    }
}
```

### Twig Extension

##### Replace Filter

Essence can replace any embeddable URL in a text by informations about it.

```
{{ 'Some random text plus http://www.youtube.com/watch?v=39e3KYAmXK4'|essence_replace }}
```

##### Embed Function

You can retrieve video informations in just one line.

```
{{ essence_embed('http://www.youtube.com/watch?v=39e3KYAmXK4').html }}
```

With max width:

```
{{ essence_embed('http://www.youtube.com/watch?v=39e3KYAmXK4', {'maxwidth': 100}).html }}
```
