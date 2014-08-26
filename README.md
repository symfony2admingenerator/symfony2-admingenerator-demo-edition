Symfony2 Admingenerator Demo Edition
========================

This repository holds a fully functional Symfony2 application
with pre-configured Admingenerator dependencies and demo bundles
acting as a showcase of Admingenerator features.

> **Note:** These demo's depend on Admingenerator v2.0, which are
not yet stable, and so, this repo is also not yet stable.

> **Note:** The demos for Doctrine ODM and Propel ORM will be added,
as soon as Doctrine ORM will be stable.

> **Note:** Old (legacy) repositories and packagist names:
>
> * AdmingeneratorGeneratorBundle
>   github: `git@github.com:symfony2admingenerator/AdmingeneratorGeneratorBundle.git`
>   packagist: "cedriclombardot/admingenerator-generator-bundle"
>
> * AvocodeFormExtensionsBundle
>   github: `git@github.com:symfony2admingenerator/AvocodeFormExtensionsBundle.git`
>   packagist: "avocode/form-extensions-bundle"
>
> **Warning:** These repositories are left for legacy users and are **NOT COMPATIBLE** with this demo.

> **Note:** I'm aware that the documentation needs much improvement, please be patient, as soon
> as I get v2.0 stable I'll rewrite the whole docs.

Installation
========================

* Download and install [composer](https://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable)
* Clone GeneratorBundle from github: `git clone https://github.com/symfony2admingenerator/symfony2-admingenerator-demo-edition.git`
* Configure your webserver to point to the web directory
* install dependencies: `composer.phar install`
* install and dumping assets: `app/console assetic:dump` and `app/console assets:install`
* install schemas to database: `app/console doctrine:schema:create`
* install fixtures: `app/console doctrine:fixtures:load`
